<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CadernoController;
use App\Http\Controllers\ComunidadeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\ProfileImageController;
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

Route::middleware('auth')->get('/caderno', [CadernoController::class, 'show'])->name('caderno.show');

Route::middleware('auth')->get('/agenda', [AgendaController::class, 'show'])->name('agenda.show');

Route::middleware('auth')->get('/comunidade', [ComunidadeController::class, 'show'])->name('comunidade.show');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('perfil')->group(function () {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/{user:username}', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/picture/edit', [ProfileImageController::class, 'edit'])->name('profile.picture.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
