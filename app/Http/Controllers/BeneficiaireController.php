<?php

namespace App\Http\Controllers;

use App\Models\Beneficiaire;
use App\Services\AppointmentPdfGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Mail\AppointmentMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class BeneficiaireController extends Controller
{
    public function index()
    {
        $beneficiaires = Beneficiaire::with('admin')->paginate(10);
        return view('beneficiaires.index', compact('beneficiaires'));
    }
    
    public function show(Beneficiaire $beneficiaire)
    {
        $beneficiaire->load('admin');
        return view('beneficiaires.show', compact('beneficiaire'));
    }
    
    /**
     * Show the form for scheduling an appointment
     */
    public function createAppointment(Beneficiaire $beneficiaire)
    {
        // Check if beneficiary already has an appointment
        if ($beneficiaire->has_appointment) {
            return redirect()->route('beneficiaire.show', $beneficiaire)
                ->with('error', 'Ce bénéficiaire a déjà un rendez-vous programmé.');
        }
        
        return view('beneficiaires.appointment', compact('beneficiaire'));
    }
    
    /**
     * Schedule an appointment and send the email
     */
    public function storeAppointment(Request $request, Beneficiaire $beneficiaire, AppointmentPdfGenerator $pdfGenerator)
    {
        // Validate the form data
        $request->validate([
            'appointment_date' => 'required|date|after:today',
        ]);
        
        // Check if beneficiary already has an appointment
        if ($beneficiaire->has_appointment) {
            return redirect()->route('beneficiaire.show', $beneficiaire)
                ->with('error', 'Ce bénéficiaire a déjà un rendez-vous programmé.');
        }
        
        // Generate QR code token for attendance tracking if not exists
        if (!$beneficiaire->qr_code_token) {
            $beneficiaire->qr_code_token = Str::random(32);
        }
        
        // Update beneficiary with appointment details
        $beneficiaire->appointment_date = $request->appointment_date;
        $beneficiaire->has_appointment = true;
        $beneficiaire->appointment_sent_at = now();
        $beneficiaire->save();
        
        try {
            // Generate PDF appointment document
            $pdfPath = $pdfGenerator->generateAndSave($beneficiaire);
            
            // Send appointment email with PDF attachment
            Mail::to($beneficiaire->email)
                ->send(new AppointmentMail($beneficiaire, $pdfPath));
                
            return redirect()->route('beneficiaire.show', $beneficiaire)
                ->with('success', 'Le rendez-vous a été programmé et l\'email a été envoyé avec succès.');
        } catch (\Exception $e) {
            \Log::error('Failed to generate or send appointment: ' . $e->getMessage());
            
            // Send email without PDF attachment
            Mail::to($beneficiaire->email)
                ->send(new AppointmentMail($beneficiaire));
                
            return redirect()->route('beneficiaire.show', $beneficiaire)
                ->with('warning', 'Le rendez-vous a été programmé et l\'email a été envoyé, mais le PDF n\'a pas pu être généré. Veuillez vérifier que la bibliothèque GD est installée.');
        }
    }
    
    /**
     * Download the appointment PDF
     */
    public function downloadAppointment(Request $request, Beneficiaire $beneficiaire, AppointmentPdfGenerator $pdfGenerator)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }
        
        try {
            // Check if GD extension is loaded
            $includeImages = extension_loaded('gd');
            
            // Generate PDF on the fly
            $pdf = $pdfGenerator->generate($beneficiaire, $includeImages);
            
            return $pdf->download('rendez_vous_' . $beneficiaire->id . '.pdf');
        } catch (\Exception $e) {
            \Log::error('Failed to generate appointment PDF for download: ' . $e->getMessage());
            
            return response()
                ->view('errors.pdf-generation-failed', [
                    'beneficiaire' => $beneficiaire,
                    'error' => $e->getMessage()
                ], 500);
        }
    }
    
    /**
     * Confirm the beneficiary's attendance
     */
    public function confirmAttendance(Beneficiaire $beneficiaire)
    {
        // Check if beneficiary has an appointment
        if (!$beneficiaire->has_appointment) {
            return redirect()->route('beneficiaire.show', $beneficiaire)
                ->with('error', 'Ce bénéficiaire n\'a pas de rendez-vous programmé.');
        }
        
        // Update beneficiary with attendance confirmation
        $beneficiaire->attendance_confirmed = true;
        $beneficiaire->attendance_confirmed_at = now();
        $beneficiaire->save();
        
        return redirect()->route('beneficiaire.show', $beneficiaire)
            ->with('success', 'La présence du bénéficiaire a été confirmée avec succès.');
    }
    
    /**
     * Record that the beneficiary did not attend their appointment
     */
    public function recordAbsence(Beneficiaire $beneficiaire)
    {
        // Check if beneficiary has an appointment
        if (!$beneficiaire->has_appointment) {
            return redirect()->route('beneficiaire.show', $beneficiaire)
                ->with('error', 'Ce bénéficiaire n\'a pas de rendez-vous programmé.');
        }
        
        // Update beneficiary with absence record
        $beneficiaire->did_not_attend = true;
        $beneficiaire->absence_recorded_at = now();
        $beneficiaire->save();
        
        return redirect()->route('beneficiaire.show', $beneficiaire)
            ->with('warning', 'L\'absence du bénéficiaire a été enregistrée.');
    }
    
    /**
     * Display a calendar view of all appointments
     */
    public function calendar()
    {
        // Get all beneficiaries with appointments
        $beneficiaires = Beneficiaire::where('has_appointment', true)
            ->orderBy('appointment_date')
            ->get();
        
        // Group appointments by date for the calendar view
        $appointments = [];
        
        foreach ($beneficiaires as $beneficiaire) {
            $date = \Carbon\Carbon::parse($beneficiaire->appointment_date)->format('Y-m-d');
            
            if (!isset($appointments[$date])) {
                $appointments[$date] = [];
            }
            
            $appointments[$date][] = [
                'id' => $beneficiaire->id,
                'name' => $beneficiaire->prenom . ' ' . $beneficiaire->nom,
                'time' => \Carbon\Carbon::parse($beneficiaire->appointment_date)->format('H:i'),
                'status' => $beneficiaire->attendance_confirmed ? 'confirmed' : 
                           ($beneficiaire->did_not_attend ? 'absent' : 'pending'),
                'beneficiaire' => $beneficiaire
            ];
        }
        
        return view('beneficiaires.calendar', compact('appointments'));
    }

    /**
     * Export beneficiary information as PDF
     */
    public function exportPdf(Beneficiaire $beneficiaire)
    {
        $beneficiaire->load('admin');
        
        // Handle photo conversion to base64 for PDF
        $photoBase64 = null;
        if ($beneficiaire->photo_path) {
            $photoPath = storage_path('app/public/' . $beneficiaire->photo_path);
            if (file_exists($photoPath)) {
                $photoData = file_get_contents($photoPath);
                $photoMimeType = mime_content_type($photoPath);
                $photoBase64 = 'data:' . $photoMimeType . ';base64,' . base64_encode($photoData);
            }
        }
        
        // Generate PDF
        $pdf = Pdf::loadView('beneficiaires.pdf', compact('beneficiaire', 'photoBase64'))
                  ->setPaper('a4', 'portrait')
                  ->setOptions([
                      'isHtml5ParserEnabled' => true,
                      'isPhpEnabled' => true,
                      'defaultFont' => 'DejaVu Sans',
                      'enable_css_float' => true,
                      'enable_html5_parser' => true
                  ]);
        
        $filename = 'beneficiaire_' . $beneficiaire->prenom . '_' . $beneficiaire->nom . '_' . $beneficiaire->id . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Display QR code scanner page for admins
     */
    public function qrScanner()
    {
        return view('beneficiaires.qr-scanner');
    }

    /**
     * Confirm attendance via QR code token
     */
    public function confirmAttendanceByQr($token)
    {
        try {
            \Log::info('QR attendance confirmation attempt', ['token' => $token, 'method' => request()->method()]);
            
            $beneficiaire = Beneficiaire::where('qr_code_token', $token)->first();
            
            if (!$beneficiaire) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'QR code invalide ou expiré.'
                ], 404);
            }
            
            return view('beneficiaires.qr-result', [
                'success' => false,
                'message' => 'QR code invalide ou expiré.',
                'beneficiaire' => null
            ]);
        }
        
        // Check if beneficiary has an appointment
        if (!$beneficiaire->has_appointment) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ce bénéficiaire n\'a pas de rendez-vous programmé.'
                ], 400);
            }
            
            return view('beneficiaires.qr-result', [
                'success' => false,
                'message' => 'Ce bénéficiaire n\'a pas de rendez-vous programmé.',
                'beneficiaire' => $beneficiaire
            ]);
        }
        
        // Check if already confirmed
        if ($beneficiaire->attendance_confirmed) {
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Présence déjà confirmée précédemment.',
                    'beneficiaire' => [
                        'id' => $beneficiaire->id,
                        'nom' => $beneficiaire->nom,
                        'prenom' => $beneficiaire->prenom,
                        'confirmed_at' => $beneficiaire->attendance_confirmed_at
                    ]
                ]);
            }
            
            return view('beneficiaires.qr-result', [
                'success' => true,
                'message' => 'Présence déjà confirmée précédemment le ' . $beneficiaire->attendance_confirmed_at->format('d/m/Y à H:i'),
                'beneficiaire' => $beneficiaire
            ]);
        }
        
        // Confirm attendance
        $beneficiaire->attendance_confirmed = true;
        $beneficiaire->attendance_confirmed_at = now();
        $beneficiaire->save();
        
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Présence confirmée avec succès!',
                'beneficiaire' => [
                    'id' => $beneficiaire->id,
                    'nom' => $beneficiaire->nom,
                    'prenom' => $beneficiaire->prenom,
                    'confirmed_at' => $beneficiaire->attendance_confirmed_at
                ]
            ]);
        }
        
        return view('beneficiaires.qr-result', [
            'success' => true,
            'message' => 'Présence confirmée avec succès!',
            'beneficiaire' => $beneficiaire
        ]);
        
        } catch (\Exception $e) {
            \Log::error('Error in QR attendance confirmation', ['error' => $e->getMessage(), 'token' => $token]);
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur serveur lors de la confirmation'
                ], 500);
            }
            
            return view('beneficiaires.qr-result', [
                'success' => false,
                'message' => 'Erreur serveur lors de la confirmation',
                'beneficiaire' => null
            ]);
        }
    }
}