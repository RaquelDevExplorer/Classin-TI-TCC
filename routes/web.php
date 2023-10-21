<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CadernoController;
use App\Http\Controllers\ComunidadeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\ProfileImageController;
use App\Http\Controllers\UserStorageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
Route::middleware('auth')->get('/comunidade', [ComunidadeController::class, 'index'])->name('comunidade.index');

// Busca arquivos de upload
// TODO: Terminar aqui
// Route::get('/file/{filename}')

// Rotas do caderno
Route::middleware('auth')->prefix('caderno')->group(function () {
    Route::get('/', [CadernoController::class, 'index'])->name('caderno.index');
    Route::post('/', [CadernoController::class, 'store'])->name('caderno.store');
    
    // Mostra a folha do caderno
    Route::get('/{folha:id}', [CadernoController::class, 'show'])->name('caderno.show');
});

// Rotas do perfil
Route::prefix('perfil')->group(function () {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/{user:username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/picture/edit', [ProfileImageController::class, 'edit'])->name('profile.picture.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
