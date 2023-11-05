<?php

namespace App\Events;

use App\Models\Reacao;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostCurtido
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Reacao $reacao;

    /**
     * Create a new event instance.
     */
    public function __construct(Reacao $reacao)
    {
        $this->reacao = $reacao;
    }
}
