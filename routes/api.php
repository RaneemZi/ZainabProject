<?php

use App\Http\Controllers\Post\FavoritePostController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
    Route::get('/showUserInfo', 'userInfo')->middleware('auth:sanctum');
});

//post routes
Route::controller(PostController::class)->group(function () {
    Route::get('/showAllPosts', 'index');
    Route::get('/showMyPosts', 'showMyPosts')->middleware('auth:sanctum');
    Route::get('/showUserPosts/{user_id}', 'showUserPosts');
    Route::get('/showPost/{post_id}', 'ShowPost');
    Route::post('/createPost', 'create')->middleware('auth:sanctum');
    Route::post('/updatePost/{id}', 'update')->middleware('auth:sanctum');
    Route::delete('/deletePost/{id}', 'delete')->middleware('auth:sanctum');
});

//favorite post routes
Route::controller(FavoritePostController::class)->group(function () {
    Route::get('/showMyFavorite', 'showMyFavorite')->middleware('auth:sanctum');
    Route::get('/showUserFavorite/{userId}', 'showUserFav');
    Route::post('/addToFavorite/{postId}', 'addToFavorites')->middleware('auth:sanctum');
    Route::delete('/removeFromFavorites/{postId}', 'removeFromFavorites')->middleware('auth:sanctum');
    Route::get('/likesCount/{postId}', 'countLikes');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
