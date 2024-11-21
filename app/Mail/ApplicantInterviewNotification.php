<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicantInterviewNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $feedback;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $feedback)
    {
        $this->user = $user;
        $this->feedback = $feedback;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: config('mail.membership_enquiry_mail_recipient'),
            subject: 'Chartered Practitioners Register: Interview Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.applicant-interview-notification',
            with: [
                'user' => $this->user,
                'feedback' => $this->feedback,
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
