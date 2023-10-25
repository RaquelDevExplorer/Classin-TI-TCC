<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Controller;

class ComunidadeApiController extends Controller
{

    public function getPosts(Request $request)
    {
        $posts = Post::with('perfil.user', 'folha', 'post_ref.perfil.user', 'comentarios.perfil.user')->paginate(10);
        return response()->json(compact('posts'));
    }

    public function storePost(Request $request)
    {
        $validated = $request->validate([
            'corpo' => 'required',
            'post_ref_id' => '',
            'folha_id' => '',
            'image' => '',
        ]);

        // TODO: testar essa parada doida AQUI
        if(isset($validated['folha_id'])) {
            $folha = Folha::find($validated['folha_id']);

            $folhaCopia = Folha::create([
                'caderno_id' => $request->user()->perfil->caderno_id,
            ]);

            $folha_content = \Storage::get(filePath($folha->caminho));
            \Storage::put($folhaCopia, $folha_content);
        }
        // ======================================

        $post = Post::create([
            'corpo' => $validated['corpo'],
            'post_ref_id' => $validated['post_ref_id'],
            'folha_id' => $validated['folha_id'],
            'image' => $validated['image'],
        ]);
    }

}
