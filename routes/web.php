<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController as ControllersProdukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin', function () {
    return view('admin.home', ['title' => 'Dashboard']);
});

Route::resource('admin/kategori', KategoriController::class);
Route::resource('admin/produk', ProdukController::class);

Route::get('/produk/{slug?}', [ControllersProdukController::class, 'index'])->name('produk');
Route::get('/produk/detail/{id}', [ControllersProdukController::class, 'show']);

Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'store'])->name('register')->middleware('guest');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout')->middleware('auth');

Route::get('/login', [\App\Http\Controllers\UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\UserController::class, 'authenticate'])->name('login')->middleware('guest');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/home', function () {
    return view('dashboard');
})->middleware('auth');
