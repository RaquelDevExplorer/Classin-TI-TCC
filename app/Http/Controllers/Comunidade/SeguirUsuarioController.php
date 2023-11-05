<?php

namespace App\Http\Controllers\Comunidade;

use App\Models\User;
use App\Models\Seguidor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeguirUsuarioController extends Controller
{

    public function store(Request $request, User $user)
    {
        if ($request->user()->id === $user->id) {
            return redirect()->back()->withErrors('Você não pode seguir você mesmo!');
        }

        Seguidor::create([
            'seguidor_id' => $request->user()->id,
            'seguido_id' => $user->id,
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request, User $user)
    {
        $request->user()->seguidos()
            ->where('seguido_id', $user->id)
            ->delete();

        return redirect()->back();
    }

}
