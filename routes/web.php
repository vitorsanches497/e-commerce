<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use App\Livewire\Register;
use App\Livewire\ProductList;
use App\Livewire\HomePage;

// Página inicial
Route::get('/', HomePage::class)->name('home');

// Rotas de convidado
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');

// Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/produtos', ProductList::class)->name('products.index');
});
