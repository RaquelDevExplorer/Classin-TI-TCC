<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\CadernoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComunidadeController;
use App\Http\Controllers\UserStorageController;
use App\Http\Controllers\Profile\ProfileImageController;

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

Route::middleware('auth')->prefix('agenda')->group(function () {
    Route::get('/', [AgendaController::class, 'index'])->name('agenda.index');
});

Route::prefix('comunidade')->group(function () {
    Route::get('/', [ComunidadeController::class, 'index'])->name('comunidade.index');
    Route::get('/post/{post:id}', [ComunidadeController::class, 'show'])->name('comunidade.show');
});

// Busca arquivos de upload
// TODO: Terminar aqui
// Route::get('/file/{filename}')

// Rotas do caderno
Route::middleware('auth')->prefix('caderno')->group(function () {
    Route::get('/', [CadernoController::class, 'index'])->name('caderno.index');
    Route::post('/', [CadernoController::class, 'store'])->name('caderno.store');
    Route::put('/{folha:id}', [CadernoController::class, 'update'])->name('caderno.update');

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

// Rotas da agenda
Route::prefix('agenda')->group(function () {
    Route::get('/', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/{dia}/{mes}/{ano}', [AgendaController::class, 'show'])->name('agenda.show');
    Route::get('/create', [AgendaController::class, 'create'])->name('agenda.create');

    // Rotas da agenda para eventos
    Route::prefix('evento')->group(function () {
        Route::post('/', [EventoController::class, 'store'])->name('agenda.evento.store');
        Route::put('/{evento:id}', [EventoController::class, 'update'])->name('agenda.evento.update');
        Route::get('/{evento:id}', [EventoController::class, 'show'])->name('agenda.evento.show');
    });
});

require __DIR__.'/auth.php';
