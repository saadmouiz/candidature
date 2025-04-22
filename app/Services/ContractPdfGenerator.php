<?php

namespace App\Services;

use App\Models\Candidature;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class ContractPdfGenerator
{
    /**
     * Generate a contract PDF for an accepted candidate
     *
     * @param Candidature $candidature
     * @param bool $includeImages Whether to include images in the PDF (requires GD extension)
     * @return \Barryvdh\DomPDF\PDF
     */
    public function generate(Candidature $candidature, bool $includeImages = true)
    {
        $data = [
            'candidature' => $candidature,
            'generatedAt' => now(),
            'includeImages' => $includeImages && extension_loaded('gd'),
        ];

        $pdf = PDF::loadView('pdfs.contract', $data);
        $pdf->setPaper('a4');
        
        return $pdf;
    }
    
    /**
     * Generate and save a contract PDF to storage
     *
     * @param Candidature $candidature
     * @return string The file path where the PDF was saved
     */
    public function generateAndSave(Candidature $candidature)
    {
        // Check if GD extension is loaded
        $includeImages = extension_loaded('gd');
        
        $pdf = $this->generate($candidature, $includeImages);
        
        $filename = 'contract_' . $candidature->id . '_' . time() . '.pdf';
        $path = 'contracts/' . $filename;
        
        // Ensure the directory exists
        if (!File::exists(storage_path('app/public/contracts'))) {
            File::makeDirectory(storage_path('app/public/contracts'), 0755, true);
        }
        
        $pdf->save(storage_path('app/public/' . $path));
        
        return $path;
    }
} 