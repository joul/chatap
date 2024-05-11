<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

//User related routes
Route::get('/', [UserController::class, 'showCorrectHomepage'])->name('login');

Route::post('/register', [UserController::class, 'register'])->middleware('guest');;

Route::post('/login', [UserController::class, 'login'])->middleware('guest');;

Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Blog posts related routes
Route::get('/create-post',[PostController::class, 'showcreateForm']);

Route::post('/create-post',[PostController::class, 'storeNewPost'])->middleware('mustBeLoggedIn');

Route::get('/post/{post}',[PostController::class, 'showSinglePost']);

Route::delete('/post/{post}',[PostController::class, 'delete'])->middleware('can:delete,post');

Route::get('/post/{post}/edit',[PostController::class, 'showEditForm'])->middleware('can:update,post');

Route::put('/post/{post}', [PostController::class, 'actuallyUpdate'])->middleware('can:update,post');

//Profile related routes
Route::get('/profile/{user:username}', [UserController::class, 'profile']);
