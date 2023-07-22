<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\UserBioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserImageController;

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

require __DIR__ . '/auth.php';
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/sort', [ContentController::class, 'sort'])->name('sort');

    Route::resource('group', GroupController::class)->only(['store', 'show', 'update']);
    Route::post('group/join', [GroupUserController::class, 'store'])->name('group.join');

    Route::resource('group.post', PostController::class)->only(['store', 'show', 'update', 'destroy']);
    Route::post('group/{group}/post/{post}/finish', [PostController::class, 'finish'])->name('group.post.finish');
    Route::resource('post.comment', PostCommentController::class)->only(['store', 'update', 'destroy']);

    Route::resource('group.user', GroupUserController::class)->only(['index']);
    Route::resource('user', UserController::class)->only(['show']);
    Route::put('user/{user}/bio', [UserBioController::class, 'update'])->name('user.bio.update');
    Route::put('user/{user}/image', [UserImageController::class, 'update'])->name('user.image.update');

    Route::fallback(function () {
        return view('notfound');
    });
});
