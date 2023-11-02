<?php

namespace App\Http\Controllers;

use App\Models\Folha;
use Illuminate\Http\Request;

class CadernoController extends Controller
{

    public function index(Request $request)
    {
        // Busca as folhas que não são públicas
        // (Folhas públicas são folhas copiadas na comunidade)
        $folhas = $request->user()
            ->caderno->folhas
            ->where('is_public', false);

        return view('caderno.index', compact('folhas'));
    }

    public function show(Request $request, Folha $folha)
    {
        $folha_json = \Storage::json($folha->caminho);
        return view('caderno.show', compact('folha_json'));
    }

    public function store(Request $request)
    {
        $folha = $request->user()->caderno->folhas()->create();
        return redirect()->route('caderno.show', $folha->id);
    }

    public function update(Request $request, Folha $folha)
    {
        $validated = $request->validate([
            'folha_json' => 'required',
        ]);

        \Storage::put($folha->caminho, json_encode($validated['json']));
        return response()->json(['message' => 'ok']);
    }

    public function destroy(Request $request, Folha $folha)
    {
        if($request->user()->caderno->id == $folha->caderno_id) {
            $folha->delete();
            return back();
        } else {
            return view('errors.403');
        }
    }

}
