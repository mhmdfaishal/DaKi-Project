<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
//routes home (gunung)
Route::get('/', [HomeController::class, 'landingpage'])->name('landingpage');
Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/{gunung:nama_gunung}', [HomeController::class, 'detail'])->name('detail.gunung');

    Route::post('/gunung/store', [HomeController::class, 'storeGunung']);
    Route::post('/gunung/update', [HomeController::class, 'updateGunung']);
    Route::delete('/gunung/delete', [HomeController::class, 'destroyGunung']);
});


// Authentication's Route
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'onLogin'])->name('login');
Route::post('/register', [RegisterController::class, 'onRegister'])->name('register');

