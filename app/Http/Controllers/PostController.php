<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_ref_id' => '',
            'folha_id' => '',
            'corpo' => 'max:1024',
            'arquivo_path' => '',
        ]);

        if(!$validated['post_ref_id']
            && !$validated['folha_id']
            && !$validated['corpo']
            && !$validated['arquivo_path'])
        {
            return back()
                ->withInput()
                ->withErrors([
                    'store' => 'Você não pode publicar um post vazio!',
                ]);
        }

        if($validated['folha_id']) {

        }

        // TODO: escrever a logica de criação do arquivo no server e salvar no banco
    }

}
