<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ComunidadeController extends Controller
{

    public function index(Request $request)
    {
        return view('comunidade.index');
    }

    public function show(Request $request, Post $post)
    {
        $post->load('comentarios', 'perfil.user');
        return view('comunidade.show', ['post' => $post]);
    }

}
