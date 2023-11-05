<?php

namespace App\Events;

use App\Models\Evento;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventoProximo
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Evento $evento;
    public String $data;

    /**
     * Create a new event instance.
     */
    public function __construct(Evento $evento, String $data)
    {
        $this->evento = $evento;
        $this->data = $data;
    }

}
