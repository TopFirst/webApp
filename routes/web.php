<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Seller;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\WebController;
use App\Models\web_about;
use App\Models\web_general_info;
use App\Models\web_layanan;

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

// Route::get('/', function () {
//     return view('index');
// })->name('index');

Route::get('/', [HomeController::class,'index'])->name('index');

Route::get('changepassword', [UserController::class,'viewchangepassword'])->name('users.viewchangepassword');
Route::post('changepassword', [UserController::class,'changepassword'])->name('users.changepassword');


Route::get('/ex', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/cekresi',[HomeController::class,'cekresi'])->name('home.cekresi');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    // Route::resource('web', WebController::class);
    Route::resource('posts', PostsController::class);
});