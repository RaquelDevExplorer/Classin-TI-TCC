<?php

namespace App\Http\Controllers;

use App\Models\Folha;
use Illuminate\Http\Request;

class CadernoController extends Controller
{

    public function index(Request $request)
    {
        $folhas = $request->user()->perfil->caderno->folhas;

        // Adiciona o JSON do storage ao objeto para enviar para a view
        foreach ($folhas as $folha) {
            $folha->json = \Storage::json($folha->caminho);
        }

        return view('caderno.index', compact('folhas'));
    }

    public function show(Request $request, Folha $folha)
    {
        $folha_json = \Storage::json($folha->caminho);
        return view('caderno.show', compact('folha_json'));
    }

    public function store(Request $request)
    {
        $folha = $request->user()->perfil->caderno->folhas()->create();
        return redirect()->route('caderno.show', $folha->id);
    }

    public function update(Request $request, Folha $folha)
    {
        $validated = $request->validate([
            'json' => 'required',
        ]);

        \Storage::put($folha->caminho, json_encode($validated['json']));
        return response()->json(['message' => 'ok']);
    }

    public function destroy(Request $request, Folha $folha)
    {
        $folha->delete();
        return back();
    }

}
