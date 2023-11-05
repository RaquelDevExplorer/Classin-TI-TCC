<?php

namespace App\Mail;

use App\Models\Comentario;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostComentadoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $comentario;

    /**
     * Create a new message instance.
     */
    public function __construct(Comentario $comentario)
    {
        $this->comentario = $comentario;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Seu Post tem um novo comentário! - Classin',
            from: 'comunidade@' . env('APP_DOMAIN'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.post-comentado',
            with: [
                'comentario' => $this->comentario
            ]
        );
    }

    public function via(): array
    {
        return ['mail'];
    }

}
