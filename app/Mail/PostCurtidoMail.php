<?php

namespace App\Mail;

use App\Models\Reacao;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostCurtidoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Reacao $reacao;

    /**
     * Create a new message instance.
     */
    public function __construct(Reacao $reacao)
    {
        $this->reacao = $reacao;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Opa, você fez um bom post - Classin',
            from: 'comunidade@' . env('APP_DOMAIN'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.post-curtido',
            with: [
                'reacao' => $this->reacao
            ]
        );
    }

    public function via(): array
    {
        return ['mail'];
    }
}
