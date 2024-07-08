<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpressionUnaccepted extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $eoi;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $eoi)
    {
        $this->user = $user;
        $this->eoi = $eoi;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Expression of Interest',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.expression-unaccepted',
            with: [
                'user' => $this->user,
                'eoi' => $this->eoi,
            ]
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
