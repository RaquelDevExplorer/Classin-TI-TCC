<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadernoController extends Controller
{

    public function show()
    {
        return view('caderno.show');
    }

}
