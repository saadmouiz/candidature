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
}