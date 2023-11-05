<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Evento;
use Illuminate\Console\Command;
use App\Jobs\SendEventoProximoJob;

class EventoProximoCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eventos:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia lembretes dos eventos próximos a acontecer de cada usuário';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $eventosHoje = Evento::whereDate('dataInicio', '=', Carbon::today())
                    ->where('lembrete', '=', 1)
                    ->where('estado', '!=', 'concluido')
                    ->get();

        $eventosAmanha = Evento::whereDate('dataInicio', '=', Carbon::tomorrow())
                    ->where('lembrete', '=', 1)
                    ->where('estado', '!=', 'concluido')
                    ->get();

        $eventosProximaSemana = Evento::whereDate('dataInicio', '=', Carbon::today()->addDays(7))
                    ->where('lembrete', '=', 1)
                    ->where('estado', '!=', 'concluido')
                    ->get();

        foreach ($eventosHoje as $e) {
            SendEventoProximoJob::dispatch($e, 'hoje');
        }

        foreach ($eventosAmanha as $e) {
            SendEventoProximoJob::dispatch($e, 'amanhã');
        }

        foreach ($eventosProximaSemana as $e) {
            SendEventoProximoJob::dispatch($e, 'semana que vem');
        }
    }
}
