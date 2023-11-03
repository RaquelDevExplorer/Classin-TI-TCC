<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use App\Enums\EventoEstadoEnum;

class AgendaController extends Controller
{

    public function index(Request $request)
    {
        $eventos = $request->user()->agenda->eventos;
        return view('agenda.index', compact('eventos'));
    }

    public function show(Request $request, int $dia, int $mes, int $ano)
    {
        $eventos = $request->user()->agenda->eventos->where([
            ['dataInicio', '>=', $ano.'-'.$mes.'-'.$dia],
        ]);

        return view('agenda.show', compact('eventos'));
    }

    public function create(Request $request)
    {
        return view('agenda.create');
    }

}
