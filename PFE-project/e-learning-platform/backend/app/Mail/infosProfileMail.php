<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class infosProfileMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $username;
    private string $password;
    private string $firstLastName;

    /**
     * Create a new message instance.
     */
    public function __construct(string $username, string $password, string $firstLastName)
    {
        $this->firstLastName = $firstLastName;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Informations de compte',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        return new Content(
            view: 'InfosCompte',
            with: [
                'firstLastName' => $this->firstLastName,
                'username' => $this->username,
                'password' => $this->password
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
