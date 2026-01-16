<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Livewire\Addresses\Index as AddressesIndex;
use App\Livewire\Addresses\Create as AddressesCreate;
use App\Livewire\CategoryList;
use App\Livewire\Dashboard;
use App\Livewire\HomePage;
use App\Livewire\Login;
use App\Livewire\ProductList;
use App\Livewire\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Addresses\Edit;

// Página inicial
Route::get('/', HomePage::class)->name('home');

// Guest
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

// Usuário autenticado
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/produtos', ProductList::class)->name('products.index');
    Route::get('/categorias', CategoryList::class)->name('categories.index');
});

// ADMIN
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);

    });

Route::middleware('auth')->group(function () {
    Route::get('/enderecos', App\Livewire\AddressManager::class)
        ->name('addresses');
});

Route::middleware('auth')->group(function () {

    Route::get('/enderecos', AddressesIndex::class)
        ->name('addresses.index');

    Route::get('/enderecos/criar', AddressesCreate::class)
        ->name('addresses.create');
    
    Route::get('/addresses/{address}/edit', Edit::class)
        ->name('addresses.edit');

});