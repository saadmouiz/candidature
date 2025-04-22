<?php
namespace App\Mail;

use App\Models\Candidature;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class CandidatureAcceptee extends Mailable
{
    use Queueable, SerializesModels;

    public $candidature;

    public function __construct(Candidature $candidature)
    {
        $this->candidature = $candidature;
    }

    public function build()
    {
        // Générer le contrat en PDF
        $pdf = PDF::loadView('pdfs.contrat', ['candidature' => $this->candidature]);
        
        // Nom du fichier PDF
        $filename = 'contrat-' . $this->candidature->id . '.pdf';
        
        return $this->subject('Votre candidature a été acceptée')
                    ->view('emails.acceptee')  // <--- Modifié ici pour correspondre à votre fichier
                    ->attachData($pdf->output(), $filename, [
                        'mime' => 'application/pdf',
                    ]);
    }
}