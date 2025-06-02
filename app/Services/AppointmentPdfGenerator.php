<?php

namespace App\Services;

use App\Models\Beneficiaire;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AppointmentPdfGenerator
{
    /**
     * Generate an appointment PDF for a beneficiary
     *
     * @param Beneficiaire $beneficiaire
     * @param bool $includeImages Whether to include images in the PDF (requires GD extension)
     * @return \Barryvdh\DomPDF\PDF
     */
    public function generate(Beneficiaire $beneficiaire, bool $includeImages = true)
    {
        // Check if GD extension is loaded for image processing
        $hasGdExtension = extension_loaded('gd');
        $canRenderImages = $includeImages && $hasGdExtension;
        
        // Verify that the logo file exists
        $logoExists = File::exists(public_path('assets/logo_ico.png'));
        if (!$logoExists) {
            Log::warning('Logo file not found at: ' . public_path('assets/logo_ico.png'));
        }
        
        // Format appointment date using Carbon
        $appointmentDate = \Carbon\Carbon::parse($beneficiaire->appointment_date);
        
        $data = [
            'beneficiaire' => $beneficiaire,
            'appointmentDate' => $appointmentDate,
            'generatedAt' => now(),
            'includeImages' => $canRenderImages && $logoExists,
            'hasLogo' => $logoExists,
        ];

        // Configure PDF options
        $pdf = PDF::loadView('pdfs.appointment', $data);
        $pdf->setPaper('a4');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'isPhpEnabled' => true,
            'isFontSubsettingEnabled' => true,
            'dpi' => 150,
        ]);
        
        return $pdf;
    }
    
    /**
     * Generate and save an appointment PDF to storage
     *
     * @param Beneficiaire $beneficiaire
     * @return string|null The file path where the PDF was saved, or null if failed
     */
    public function generateAndSave(Beneficiaire $beneficiaire)
    {
        try {
        // Check if GD extension is loaded
        $includeImages = extension_loaded('gd');
        
        $pdf = $this->generate($beneficiaire, $includeImages);
        
        $filename = 'appointment_' . $beneficiaire->id . '_' . time() . '.pdf';
        $path = 'appointments/' . $filename;
        
        // Ensure the directory exists
        if (!File::exists(storage_path('app/public/appointments'))) {
            File::makeDirectory(storage_path('app/public/appointments'), 0755, true);
        }
        
        $pdf->save(storage_path('app/public/' . $path));
        
            // Verify the file was created
            if (File::exists(storage_path('app/public/' . $path))) {
        return $path;
            } else {
                Log::error('Failed to create PDF file at: ' . storage_path('app/public/' . $path));
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Exception during PDF generation: ' . $e->getMessage());
            return null;
        }
    }
} 