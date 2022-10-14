<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GroupController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::controller(GoogleController::class)->group(function(){

    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');

    Route::get('auth/google/callback', 'handleGoogleCallback');

});

Route::controller(HomeController::class)->group(function () {
    Route::get('test', 'index');
    Route::post('add', 'add');
    Route::post('del', 'del');
    Route::post('join', 'join');
});

Route::match(array('GET','POST'),'group/{id}', [GroupController::class, 'show']);
