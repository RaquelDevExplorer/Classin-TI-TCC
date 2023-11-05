<?php

namespace App\Events;

use App\Models\Comentario;
use Illuminate\Mail\Mailable;
use Illuminate\Broadcasting\Channel;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostComentado extends Mailable
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comentario;

    /**
     * Create a new event instance.
     */
    public function __construct(Comentario $comentario)
    {
        $this->comentario = $comentario;
    }

}
