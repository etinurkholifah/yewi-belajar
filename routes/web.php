<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use League\Flysystem\UrlGeneration\PrefixPublicUrlGenerator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group([
    "middleware"=>["guest"]
], function(){
    Route::get('/login',[App\Http\Controllers\LoginController::class,'index'])->name('login');
    Route::post('/login-proses',[App\Http\Controllers\LoginController::class,'login_proses'])->name('login-proses');
    Route::get('/register',[App\Http\Controllers\LoginController::class,'register'])->name('register');
    Route::post('/register-proses',[App\Http\Controllers\LoginController::class,'register_proses'])->name('register-proses');
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

});
Route::get('/', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/logout',[App\Http\Controllers\LoginController::class,'logout'])->name('logout');

Route::get('/user',[App\Http\Controllers\HomeController::class,'index'])->name('index');

Route::get('/create',[App\Http\Controllers\HomeController::class,'create'])->name('user.create');
Route::post('/store',[App\Http\Controllers\HomeController::class,'store'])->name('user.store');

Route::get('/edit/{id}',[App\Http\Controllers\HomeController::class,'edit'])->name('user.edit');
Route::put('/update/{id}',[App\Http\Controllers\HomeController::class,'update'])->name('user.update');
Route::delete('/delete/{id}',[App\Http\Controllers\HomeController::class,'delete'])->name('user.delete');




// Route::get('/user', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');
//Route::get('/user',[HomeController::class,'index']);
