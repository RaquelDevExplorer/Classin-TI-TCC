<?php

namespace App\Jobs;

use App\Models\Evento;
use App\Events\EventoProximo;
use Illuminate\Bus\Queueable;
use App\Listeners\SendEventoProximo;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEventoProximoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Evento $evento;
    protected String $data;

    /**
     * Create a new job instance.
     */
    public function __construct(Evento $evento, String $data)
    {
        $this->evento = $evento;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $evento = new EventoProximo($this->evento, $this->data);
        event($evento);
    }
}
