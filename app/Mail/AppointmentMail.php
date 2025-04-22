<?php

namespace App\Mail;

use App\Models\Beneficiaire;
use App\Services\AppointmentPdfGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The beneficiary instance.
     *
     * @var \App\Models\Beneficiaire
     */
    public $beneficiaire;

    /**
     * The PDF file path.
     *
     * @var string|null
     */
    protected $pdfPath;
    
    /**
     * Flag to determine if PDF generation failed
     * 
     * @var bool
     */
    protected $pdfGenerationFailed = false;

    /**
     * Create a new message instance.
     */
    public function __construct(Beneficiaire $beneficiaire, ?string $pdfPath = null)
    {
        $this->beneficiaire = $beneficiaire;
        $this->pdfPath = $pdfPath;
        
        // If the path is not provided, set the flag to indicate failure
        if ($pdfPath === null) {
            $this->pdfGenerationFailed = true;
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Rendez-vous de suivi - Programme des bénéficiaires',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment',
            with: [
                'pdfGenerationFailed' => $this->pdfGenerationFailed,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->pdfGenerationFailed || $this->pdfPath === null) {
            return [];
        }
        
        try {
            $filePath = storage_path('app/public/' . $this->pdfPath);
            
            // Check if file exists
            if (!Storage::disk('public')->exists($this->pdfPath)) {
                Log::error('Appointment PDF file not found: ' . $filePath);
                return [];
            }
            
            return [
                Attachment::fromPath($filePath)
                        ->as('rendez_vous_' . $this->beneficiaire->id . '.pdf')
                        ->withMime('application/pdf'),
            ];
        } catch (\Exception $e) {
            Log::error('Failed to attach appointment PDF: ' . $e->getMessage());
            return [];
        }
    }
} 