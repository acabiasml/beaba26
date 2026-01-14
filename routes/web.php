<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Setup\FirstAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Setup inicial (somente se não houver usuários)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/setup', [FirstAdminController::class, 'create'])
        ->name('setup.create');

    Route::post('/setup', [FirstAdminController::class, 'store'])
        ->name('setup.store');
});

/*
|--------------------------------------------------------------------------
| Autenticação Google
|--------------------------------------------------------------------------
*/
Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'active'])->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Cadastro de usuários (gestor / administrador)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'can:gestor'])->group(function () {
    Route::get('/usuarios/novo', [UserController::class, 'create'])
        ->name('users.create');

    Route::post('/usuarios', [UserController::class, 'store'])
        ->name('users.store');
});
