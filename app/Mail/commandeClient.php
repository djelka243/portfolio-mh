<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class commandeClient extends Mailable
{
    use Queueable, SerializesModels;
        public $commande;

        /**
         * Create a new message instance.
         */
        public function __construct($commande)
        {
            $this->commande = $commande;
        }

        /**
         * Get the message envelope.
         */
        public function envelope(): Envelope
        {
            return new Envelope(
                subject: 'Confirmation de commande - ' . $this->commande->numero_commande,
            );
        }

        /**
         * Get the message content definition.
         */
        public function content(): Content
        {
            return new Content(
                view: 'emails.commande-client',
                with: [
                    'commande' => $this->commande,
                    'produits' => $this->commande->produits,
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
        return [];
    }
}
