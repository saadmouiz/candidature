<?php

namespace App\Services;

use App\Models\Beneficiaire;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

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
        
        // Ensure QR code token exists
        if (!$beneficiaire->qr_code_token) {
            $beneficiaire->qr_code_token = Str::random(32);
            $beneficiaire->save();
        }
        
        // Generate QR code for PDF embedding using SVG format
        $qrCodeBase64 = null;
        $qrCodeSvg = null;
        try {
            $qrCodeData = route('qr.attendance', ['token' => $beneficiaire->qr_code_token]);
            Log::info('Generating QR code for URL: ' . $qrCodeData);
            
            // Use bacon/bacon-qr-code directly with SVG backend (no imagick required)
            $backend = new \BaconQrCode\Renderer\Image\SvgImageBackEnd();
            $rendererStyle = new \BaconQrCode\Renderer\RendererStyle\RendererStyle(300);
            $renderer = new \BaconQrCode\Renderer\ImageRenderer($rendererStyle, $backend);
            $writer = new \BaconQrCode\Writer($renderer);
            
            $qrCodeSvg = $writer->writeString($qrCodeData);
            
            if ($qrCodeSvg && strlen($qrCodeSvg) > 0) {
                // Convert SVG to base64 data URI for PDF embedding
                $qrCodeBase64 = 'data:image/svg+xml;base64,' . base64_encode($qrCodeSvg);
                Log::info('QR code generated successfully as SVG for beneficiary: ' . $beneficiaire->id . ' (size: ' . strlen($qrCodeSvg) . ' bytes)');
            } else {
                throw new \Exception('QR code generation returned empty result');
            }
        } catch (\Exception $e) {
            Log::error('Failed to generate QR code: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            $qrCodeBase64 = null;
            $qrCodeSvg = null;
        }
        
        // Format appointment date using Carbon
        $appointmentDate = \Carbon\Carbon::parse($beneficiaire->appointment_date);
        
        $data = [
            'beneficiaire' => $beneficiaire,
            'appointmentDate' => $appointmentDate,
            'generatedAt' => now(),
            'includeImages' => $canRenderImages && $logoExists,
            'hasLogo' => $logoExists,
            'qrCodeBase64' => $qrCodeBase64,
            'qrCodeSvg' => $qrCodeSvg,
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