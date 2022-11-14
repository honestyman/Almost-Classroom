<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PostController;

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

require __DIR__.'/auth.php';

Route::controller(GoogleController::class)->group(function(){

    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');

    Route::get('auth/google/callback', 'handleGoogleCallback');

});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::post('/add', [HomeController::class, 'add']);
    Route::post('/del', [HomeController::class, 'del']);
    Route::post('/join', [HomeController::class, 'join']);
});



Route::match(array('GET','POST'),'group/{id}', [GroupController::class, 'show']);
Route::match(array('GET','POST'),'group/{id}/post/{id2}', [PostController::class, 'show'])->name('post_ideal');

Route::group(['middleware' => 'auth'], function() {
    Route::post('/finished', [PostController::class, 'finished']);
});
