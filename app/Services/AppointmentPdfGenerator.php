<?php

namespace App\Services;

use App\Models\Beneficiaire;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

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
        $data = [
            'beneficiaire' => $beneficiaire,
            'appointmentDate' => \Carbon\Carbon::parse($beneficiaire->appointment_date),
            'generatedAt' => now(),
            'includeImages' => $includeImages && extension_loaded('gd'),
        ];

        $pdf = PDF::loadView('pdfs.appointment', $data);
        $pdf->setPaper('a4');
        
        return $pdf;
    }
    
    /**
     * Generate and save an appointment PDF to storage
     *
     * @param Beneficiaire $beneficiaire
     * @return string The file path where the PDF was saved
     */
    public function generateAndSave(Beneficiaire $beneficiaire)
    {
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
        
        return $path;
    }
} 