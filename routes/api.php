<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Retorna as escolas já cadastradas por alunos no perfil
Route::get('/escolas', function () {
    $escolas = App\Models\Perfil::distinct()->pluck('escola');
    return json_encode(compact('escolas'));
})->name('api.escolas');

// Retorna posts da comunidade em paginação
Route::get('/comunidade/posts', [App\Http\Controllers\API\ComunidadeApiController::class, 'getPosts'])->name('api.comunidade.posts');
