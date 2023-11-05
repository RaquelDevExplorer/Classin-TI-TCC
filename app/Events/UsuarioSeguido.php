<?php

namespace App\Events;

use App\Models\User;
use App\Models\Seguidor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UsuarioSeguido
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Seguidor $seguidor;

    /**
     * Create a new event instance.
     */
    public function __construct(Seguidor $seguidor)
    {
        $this->seguidor = $seguidor;
    }
}
