<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\BasecampController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransaksiController;
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

//Route for AJAX
Route::get('/fetchgunung', [HomeController::class, 'fetchGunung']);
Route::get('/fetchlocation', [HomeController::class, 'fetchLocation']);
Route::get('/fetchtoko', [RentController::class, 'fetchToko']);
Route::get('/fetchlocationtoko', [RentController::class, 'fetchLocation']);
Route::get('/fetchbarang', [RentController::class, 'fetchBarang']);

// Authentication's Route
Route::post('/login', [LoginController::class, 'onLogin'])->name('login');
Route::post('/register', [RegisterController::class, 'onRegister'])->name('register');
Route::get('/auth/google/redirect', [LoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/callback', [RegisterController::class, 'handleGoogleCallback']);

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/{gunung:id}', [HomeController::class, 'detail'])->name('detail.gunung');
});


Route::prefix('sewa')->group(function () {
    Route::get('/', [RentController::class, 'index'])->name('index.marketplace');
    Route::get('/penyewaan', [RentController::class, 'getPenyewaan'])->name('penyewaan.user');
    Route::get('/{toko:nama_toko}', [RentController::class, 'detailToko'])->name('detail.toko');
});

Route::prefix('toko')->group(function () {
    Route::get('/barang/detailbarang/{id}', [StoreController::class, 'detailBarang']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'onLogout'])->middleware('useres')->name('logout');
    
    Route::prefix('toko')->group(function () {
        Route::post('/followunfollow', [StoreController::class, 'followUnfollow']);
    });
});

//Filtering for Backpacker
Route::middleware(['auth', 'is_backpacker'])->group(function () {
    // Keranjang
    Route::prefix('keranjang')->group(function () {
        Route::get('/', [KeranjangController::class, 'index'])->name('keranjang');
        Route::get('/checkout', [KeranjangController::class, 'checkout'])->name('checkout');
        Route::post('/checkout/tanggalsewa', [KeranjangController::class, 'tanggalSewa']);
        Route::post('/add', [KeranjangController::class, 'addBarang'])->name('add.cart');
        Route::post('/store/minus', [KeranjangController::class, 'storeMinus'])->name('storeminus.cart');
        Route::post('/store/plus', [KeranjangController::class, 'storePlus'])->name('storeplus.cart');
        Route::delete('/barang/delete/{id}', [KeranjangController::class, 'deleteBarang'])->name('delete.barang.cart');
        Route::get('/penyewaan', [RentController::class, 'getPenyewaan'])->name('penyewaan.user');
        Route::post('/checkout/bayar', [TransaksiController::class, 'store']);
    });

    //Route Penyewaan
    Route::prefix('sewa')->group(function () {
        Route::get('/detailpenyewaan/{id}', [RentController::class, 'detailPenyewaan']);
    });
});

//Filtering for Basecamp Admin
Route::middleware(['auth', 'is_admin_basecamp'])->group(function () {
    //Route CRUD Gunung
    Route::prefix('basecamp')->group(function() {
        Route::get('/', [BasecampController::class, 'index'])->name('index.admin.gunung');
        Route::post('/gunung/store', [BasecampController::class, 'storeGunung']);
        Route::post('/gunung/update', [BasecampController::class, 'updateGunung']);
        Route::delete('/gunung/delete/{id}', [BasecampController::class, 'destroyGunung']);
    });
});

//Filtering for Store Staff
Route::middleware(['auth', 'is_admin_toko'])->group(function () {
    //CRUD Toko
    Route::prefix('toko')->group(function () {
        Route::get('/info', [StoreController::class, 'detail'])->name('admin.detail.toko');
        Route::get('/barang/edit/{id}', [StoreController::class, 'getBarang']);
        Route::delete('/barang/delete/{id}', [StoreController::class, 'destroyBarang']);
        Route::delete('/delete/{id}', [StoreController::class, 'destroyToko']);
        Route::post('/detail/save-detail', [StoreController::class, 'storeToko']);
        Route::post('/barang/store', [StoreController::class, 'storeBarang']);
        Route::post('/followunfollow', [StoreController::class, 'followUnfollow']);
    });

    // Pesanan (Admin toko)
    Route::get('/cart', [OrderController::class, 'Cart'])->name('pesanan'); 
});