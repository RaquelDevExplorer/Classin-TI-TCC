<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CadernoApiController extends Controller
{

    public function getFolhas(Request $request)
    {
        $folhas = $request->user()->perfil->caderno->folhas->where('is_public', false);
        return response()->json(compact('folhas'));
    }

}
