<?php

namespace App\Listeners;

use DateTime;
use App\Events\EventoProximo;
use App\Mail\EventoProximoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEventoProximo implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EventoProximo $event): void
    {
        $email = new EventoProximoMail($event->evento, $event->data);
        $user = $event->evento->agenda->user;

        Mail::to($user)->send($email);
    }

    public function retryUntil(): DateTime
    {
        return now()->addMinutes(5);
    }
}
