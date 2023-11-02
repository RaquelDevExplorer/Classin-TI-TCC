<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Folha;
use App\Http\Controllers\Controller;

class ComunidadeApiController extends Controller
{

    public function getPosts(Request $request)
    {
        $posts = Post::with('perfil.user', 'folha', 'post_ref.perfil.user', 'comentarios.perfil.user')->latest()->paginate(10);
        return response()->json(compact('posts'));
    }

    public function storePost(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required',
            'post_ref_id' => '',
            'folha_id' => '',
            'image' => '',
            'file' => '',
        ]);

        // Cria cópia pública da folha
        if(isset($validated['folha_id'])) {
            $folha = Folha::find($validated['folha_id']);
            $folhaCopia = $request->user()->caderno->folhas()->create([
                'is_public' => true,
            ]);

            $folha_content = \Storage::get($folha->caminho);
            \Storage::put($folhaCopia->caminho, $folha_content);
        }

        // Salva imagem
        $imagePath = null;

        if (isset($validated['image'])) {
            $imagePath = 'public/posts/' . $request->user()->id . '/';
            $hashName =  $validated['image']->hashName();
            $request->file('image')->store($imagePath);

            $imagePath = $imagePath . $hashName;
        }

        // Salva arquivo
        // TODO: Implementar upload de arquivos

        $request->user()->perfil->posts()->create([
            'corpo' => $validated['body'],
            'post_ref_id' => $validated['post_ref_id'] ?? null,
            'folha_id' => $validated['folha_id'] ?? null,
            'image' => $imagePath,
            'file' => $validated['file'] ?? null,
        ]);
    }

    public function repost(Request $request)
    {
        $validated = $request->validate([
            'post_ref_id' => 'required',
            'body' => '',
        ]);


        $request->user()->perfil->posts()->create([
            'corpo' => $validated['body'],
            'post_ref_id' => $validated['post_ref_id'],
        ]);
    }

}
