<?php

namespace App\Http\Controllers\Api;

use App\Models\Reacao;
use Illuminate\Http\Request;
use App\Enums\ReacaoTypeEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReacaoApiController extends Controller
{

    public function toggleReacao(Request $request, int $target_id, ReacaoTypeEnum $target_type)
    {
        $reacao = null;
        
        switch ($target_type) {
            case ReacaoTypeEnum::POST:
                $reacao = Reacao::find([
                    'post_id' => $target_id,
                    'perfil_id' => $request->user()->id
                ])[0] ?? null;
                break;

            case ReacaoTypeEnum::COMENTARIO:
                $reacao = Reacao::find([
                    'comentario_id' => $target_id,
                    'perfil_id' => $request->user()->id
                ])[0] ?? null;
                break;
        }

        if(isset($reacao)) { // deleta reação se existir
            $reacao->delete();

            return response()->json([
                'success' => true
            ]);
        } else {
            Reacao::create([ // cria reação caso não exista
                'perfil_id' => $request->user()->id,
                'post_id' => $target_type == ReacaoTypeEnum::POST ? $target_id  : null,
                'comentario_id' => $target_type == ReacaoTypeEnum::COMENTARIO ? $target_id  : null,
                'target_type' => $target_type,
            ]);

            return response()->json([
                'success' => true
            ]);
        }
    }

}
