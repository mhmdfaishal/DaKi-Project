<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BasecampController;
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
Route::get('/fetchgunung', [HomeController::class, 'fetchGunung']);
Route::get('/fetchtoko', [RentController::class, 'fetchToko']);
Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/{gunung:nama_gunung}', [HomeController::class, 'detail'])->name('detail.gunung');
    // Route::get('/gunung/getdata', [HomeController::class, 'getGunung'])->name('get.gunung');
   
});

//routes sewa (toko)
Route::prefix('basecamp')->group(function() {
    Route::get('/', [BasecampController::class, 'index'])->name('index.admin.gunung');
    Route::post('/gunung/store', [BasecampController::class, 'storeGunung']);
    Route::post('/gunung/update', [BasecampController::class, 'updateGunung']);
    Route::delete('/gunung/delete/{id}', [BasecampController::class, 'destroyGunung']);
});
Route::prefix('sewa')->group(function () {
    Route::get('/', [RentController::class, 'index'])->name('index.marketplace');
    Route::get('/{toko}', [RentController::class, 'detailToko'])->name('detail.toko');
});

Route::prefix('store')->group(function () {
    Route::get('/detail', [StoreController::class, 'detail'])->name('admin.detail.toko');
    Route::post('/detail/save-detail', [StoreController::class, 'storeToko']);
});

// Authentication's Route
Route::post('/login', [LoginController::class, 'onLogin'])->name('login');
Route::post('/register', [RegisterController::class, 'onRegister'])->name('register');
Route::get('/logout', [LoginController::class, 'onLogout'])->middleware('useres')->name('logout');
Route::get('/auth/google/redirect', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/callback', [RegisterController::class, 'handleGoogleCallback']);

// Pesanan
Route::get('/cart', [OrderController::class, 'Cart'])->name('pesanan');