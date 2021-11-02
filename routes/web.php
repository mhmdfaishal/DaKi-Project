<?php
use App\Http\Controllers\HomeController;
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
Route::get('/home', [HomeController::class, 'index'])->name('index');
Route::get('/home/{gunung:nama_gunung}', [HomeController::class, 'detail']);

Route::post('/home/gunung/store', [HomeController::class, 'storeGunung']);
Route::post('/home/gunung/update', [HomeController::class, 'updateGunung']);

