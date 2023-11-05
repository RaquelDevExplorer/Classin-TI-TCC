<?php

namespace App\Mail;

use App\Models\Evento;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventoProximoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Evento $evento;
    protected String $data;

    /**
     * Create a new message instance.
     */
    public function __construct(Evento $evento, String $data)
    {
        $this->evento = $evento;
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "\"{$this->evento->titulo}\" é {$this->data}! - Eventos Classin",
            from: 'agenda@' . env('APP_DOMAIN'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.evento-proximo',
            with: [
                'evento' => $this->evento,
                'dataString' => $this->data,
            ]
        );
    }

    public function via(): array
    {
        return ['mail'];
    }

}
