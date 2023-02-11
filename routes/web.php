<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ContentController;
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

require __DIR__.'/auth.php';

Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::get('/test', function() {
    return "<h1>Ahoj</h1>";
})->middleware('auth', 'verified')->name('test');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/add/{id?}', [HomeController::class, 'add'])->name('add');
    Route::post('/del/{id}', [HomeController::class, 'del'])->name('del');
    Route::post('/join', [HomeController::class, 'join'])->name('join');
    Route::post('/finished/{id}', [PostController::class, 'finished'])->name('finished');
    Route::match(array('GET','POST'),'group/{id}', [GroupController::class, 'show'])->name('group');
    Route::match(array('GET','POST'),'group/{id}/post/{id2}', [PostController::class, 'show'])->name('post');
    Route::match(array('GET','POST'),'group/{id}/users', [GroupController::class, 'users']);
    Route::match(array('GET','POST'),'user/{id}', [GroupController::class, 'user'])->name('user');
});

Route::get('/sort',[ContentController::class, 'sort'])->name('sort');
