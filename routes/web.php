<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;


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
    Route::group(['prefix' => 'comment', 'as' => 'comment.'], function() {
        Route::post('add/{id}', [CommentController::class, 'add'])->name('add');
        Route::post('edit/{comment}', [CommentController::class, 'edit'])->name('edit');
        Route::post('delete/{comment}', [CommentController::class, 'delete'])->name('delete');
    });
    Route::group(['prefix' => 'post', 'as' => 'post.'], function() {
        Route::post('add/{id}', [PostController::class, 'add'])->name('add');
        Route::post('edit/{post}', [PostController::class, 'edit'])->name('edit');
        Route::post('finished/{id}', [PostController::class, 'finished'])->name('finished');
    });
    Route::group(['prefix' => 'group', 'as' => 'group.'], function() {
        Route::post('add', [GroupController::class, 'add'])->name('add');
        Route::post('join', [GroupController::class, 'join'])->name('join');
        Route::post('leave', [GroupController::class, 'join'])->name('leave');
        Route::post('delete/{group}', [GroupController::class, 'delete'])->name('delete');
    });
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/add/{id?}', [HomeController::class, 'add'])->name('add');
    Route::post('/del/{id}', [HomeController::class, 'del'])->name('del');
    Route::match(array('GET','POST'),'group/{id}', [GroupController::class, 'show'])->name('group');
    Route::match(array('GET','POST'),'group/{id}/users', [GroupController::class, 'users']);
    Route::match(array('GET','POST'),'user/{id}', [GroupController::class, 'user'])->name('user');
    Route::match(array('GET','POST'),'group/{id}/post/{id2}', [PostController::class, 'show'])->name('post');
});

Route::get('/sort',[ContentController::class, 'sort'])->name('sort');
