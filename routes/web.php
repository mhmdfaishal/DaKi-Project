<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BasecampController;
use App\Http\Controllers\KeranjangController;
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
Route::get('/fetchlocation', [HomeController::class, 'fetchLocation']);
Route::get('/fetchtoko', [RentController::class, 'fetchToko']);
Route::get('/fetchlocationtoko', [RentController::class, 'fetchLocation']);
Route::get('/fetchbarang', [RentController::class, 'fetchBarang']);
Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/{gunung:id}', [HomeController::class, 'detail'])->name('detail.gunung');
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
    Route::get('/{toko:nama_toko}', [RentController::class, 'detailToko'])->name('detail.toko');
});

Route::prefix('toko')->group(function () {
    Route::get('/info', [StoreController::class, 'detail'])->name('admin.detail.toko');
    Route::get('/barang/edit/{id}', [StoreController::class, 'getBarang']);
    Route::get('/barang/detailbarang/{id}', [StoreController::class, 'detailBarang']);
    Route::delete('/barang/delete/{id}', [StoreController::class, 'destroyBarang']);
    Route::delete('/delete/{id}', [StoreController::class, 'destroyToko']);
    Route::post('/detail/save-detail', [StoreController::class, 'storeToko']);
    Route::post('/barang/store', [StoreController::class, 'storeBarang']);
    Route::post('/followunfollow', [StoreController::class, 'followUnfollow']);
});

// Authentication's Route
Route::post('/login', [LoginController::class, 'onLogin'])->name('login');
Route::post('/register', [RegisterController::class, 'onRegister'])->name('register');
Route::get('/logout', [LoginController::class, 'onLogout'])->middleware('useres')->name('logout');
Route::get('/auth/google/redirect', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/callback', [RegisterController::class, 'handleGoogleCallback']);

// Pesanan (Admin toko)
Route::get('/cart', [OrderController::class, 'Cart'])->name('pesanan');

// Keranjang
Route::prefix('keranjang')->group(function () {
    Route::get('/', [KeranjangController::class, 'index'])->name('keranjang');
    Route::get('/checkout', [KeranjangController::class, 'checkout'])->name('checkout');
    Route::post('/add', [KeranjangController::class, 'addBarang'])->name('add.cart');
    Route::post('/store/minus', [KeranjangController::class, 'storeMinus'])->name('storeminus.cart');
    Route::post('/store/plus', [KeranjangController::class, 'storePlus'])->name('storeplus.cart');
    Route::delete('/barang/delete/{id}', [KeranjangController::class, 'deleteBarang'])->name('delete.barang.cart');
});
