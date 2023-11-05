<?php

namespace App\Mail;

use App\Models\Seguidor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class UsuarioSeguidoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $seguidor;

    /**
     * Create a new message instance.
     */
    public function __construct(Seguidor $seguidor)
    {
        $this->seguidor = $seguidor;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Parabéns! Você tem um novo seguidor - Classin',
            from: 'comunidade@' . env('APP_DOMAIN'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.usuario-seguido',
            with: [
                'seguidor' => $this->seguidor
            ]
        );
    }

    public function via()
    {
        return ['mail'];
    }
}
