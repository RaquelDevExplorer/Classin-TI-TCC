<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Enums\EventoEstadoEnum;

// TODO: serviço de notificação pelo lembre do evento
class EventoController extends Controller
{

    public function show(Request $request, Evento $evento)
    {
        return view('agenda.evento.show', compact('evento'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required',
            'descricao' => '',
            'dataInicio' => 'required',
            'dataFim' => 'required',
            'lembrete' => '',
        ]);

        $evento = $request->user()->agenda->eventos()->create([
            ...$validated,
            'estado' => EventoEstadoEnum::PENDENTE,
        ]);

        return redirect()->route('agenda.show', $evento->id);
    }

    public function update(Request $request, Evento $evento)
    {
        if($evento->agenda_id !== $request->user()->agenda->id) {
            return response()->view('errors.403', [
                'message' => 'Esse evento não pertence a sua Agenda!',
            ], 403);
        }

        $validated = $request->validate([
            'titulo' => '',
            'descricao' => '',
            'dataInicio' => '',
            'dataFim' => '',
            'estado' => '',
            'lembrete' => '',
        ]);

        $estadoExists = EventoEstadoEnum::tryFrom($validated['estado']);
        if(!$estadoExists) {
            return response()->view('errors.403', [
                'message' => 'Estado do evento não permitido!',
            ], 403);
        }

        $evento->update($validated);
        return redirect()->route('agenda.index');
    }

}
