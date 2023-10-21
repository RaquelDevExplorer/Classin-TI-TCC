<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComunidadeController extends Controller
{

    public function index(Request $request)
    {
        $perfil = $request->user()->perfil;
        return view('comunidade.index', compact('perfil'));
    }

}
