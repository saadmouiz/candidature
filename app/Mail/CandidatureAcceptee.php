<?php
namespace App\Mail;

use App\Models\Candidature;
use App\Services\ContractPdfGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Log;

class CandidatureAcceptee extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The candidature instance.
     *
     * @var \App\Models\Candidature
     */
    public $candidature;
    
    /**
     * The contract PDF generator
     * 
     * @var \App\Services\ContractPdfGenerator
     */
    protected $contractGenerator;

    /**
     * Create a new message instance.
     */
    public function __construct(Candidature $candidature)
    {
        $this->candidature = $candidature;
        $this->contractGenerator = new ContractPdfGenerator();
    }
    
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Félicitations ! Votre candidature a été acceptée',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.acceptee',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        try {
            // Check for GD extension
            $includeImages = extension_loaded('gd');
            
            // Generate PDF
            $pdf = $this->contractGenerator->generate($this->candidature, $includeImages);
            
            return [
                Attachment::fromData(
                    function() use ($pdf) {
                        return $pdf->output();
                    }, 
                    'contrat-' . $this->candidature->id . '.pdf'
                )->withMime('application/pdf'),
            ];
        } catch (\Exception $e) {
            // Log the error but don't block the email from being sent
            Log::error('Failed to generate contract PDF: ' . $e->getMessage());
            return [];
        }
    }
}