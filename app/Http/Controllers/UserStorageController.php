<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserStorageController extends Controller
{

    public function showFolhas(Request $request, $type, $filename)
    {
        $file = $type == 'public'
            ? \Storage::get("public/folhas/$filename")
            : \Storage::get("folhas/{$request->user()->username}/$filename");

        $response = \Response::make($file, 200);
        return $response;
    }

    public function showFiles(Request $request, $type, $filename)
    {
        $file = $type == 'public'
            ? \Storage::get("public/files/$filename")
            : \Storage::get("files/{$request->user()->username}/$filename");

        $response = \Response::make($file, 200);
        return $response;
    }

}
