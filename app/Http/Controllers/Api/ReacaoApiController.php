<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\ReacaoTypeEnum;
use App\Models\Reacao;

class ReacaoApiController extends Controller
{

    public function toggleReacao(Request $request, int $target_id, ReacaoTypeEnum $target_type)
    {
        $reacao = null;
        switch ($target_type) {
            case ReacaoTypeEnum::Post:
                $reacao = Reacao::find([
                    'post_id' => $target_id,
                    'perfil_id' => $request->user()->id
                ])[0] ?? null;
                break;

            case ReacaoTypeEnum::Comentario:
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
                'post_id' => $target_type == ReacaoTypeEnum::Post ? $target_id  : null,
                'comentario_id' => $target_type == ReacaoTypeEnum::Comentario ? $target_id  : null,
                'target_type' => $target_type,
            ]);

            return response()->json([
                'success' => true
            ]);
        }
    }

}
