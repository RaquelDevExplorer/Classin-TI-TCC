<?php

namespace App\Listeners;

use App\Events\PostCurtido;
use App\Mail\PostCurtidoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPostCurtido
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
    public function handle(PostCurtido $event): void
    {
        $email = new PostCurtidoMail($event->reacao);
        $user = $event->reacao->perfil->user;

        Mail::to($user)->send($email);
    }

    public function retryUntil(): DateTime
    {
        return now()->addMinutes(5);
    }
}
