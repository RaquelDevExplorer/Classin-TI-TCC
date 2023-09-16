<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileImageController extends Controller
{

    /**
     * Edit the user's profile image.
     */
    public function edit(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = Image::make($request->file('foto'))->fit(200, 200)->encode('jpg');

        $imgName = $request->file('foto')->hashName();
        \Storage::put("public/profiles/$imgName", $image->__toString());

        $request->user()->perfil->update(['foto' => $imgName]);
        return back()->with('success', 'Imagem enviada e cortada com sucesso.');
    }

}
