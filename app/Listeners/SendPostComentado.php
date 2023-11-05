<?php

namespace App\Listeners;

use DateTime;
use App\Events\PostComentado;
use App\Mail\PostComentadoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPostComentado implements ShouldQueue
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
    public function handle(PostComentado $event): void
    {
        $email = new PostComentadoMail($event->comentario);
        $user = $event->comentario->post->perfil->user;

        Mail::to($user)->send($email);
    }

    public function retryUntil(): DateTime
    {
        return now()->addMinutes(5);
    }
}
