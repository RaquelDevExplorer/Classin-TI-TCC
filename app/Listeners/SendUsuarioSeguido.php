<?php

namespace App\Listeners;

use App\Events\UsuarioSeguido;
use App\Mail\UsuarioSeguidoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUsuarioSeguido
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
    public function handle(UsuarioSeguido $event): void
    {
        $email = new UsuarioSeguidoMail($event->seguidor);
        $user = $event->seguidor->seguido;

        Mail::to($user)->send($email);
    }

    public function retryUntil(): DateTime
    {
        return now()->addMinutes(5);
    }
}
