<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::get('/settings',[UserController::class,'settings'])->middleware('auth');
Route::get('/changePassword',[UserController::class,'changePassword'])->middleware('auth');
Route::post('/savePassword',[UserController::class,'savePassword'])->middleware('auth');
Route::post('/update',[UserController::class,'update'])->middleware('auth');
Route::get('/getImage/{name}',[UserController::class,'getImage'])->middleware('auth');

Route::get('/uploadImage',[ImageController::class,'uploadImage'])->middleware('auth');
Route::post('/uploadImageSave',[ImageController::class,'uploadImageSave'])->middleware('auth');
Route::get('/getImagePost/{name}',[ImageController::class,'getImagePost'])->middleware('auth');
Route::get('/detail/{id}', [ImageController::class,'detail'])->middleware('auth');
Route::post('/saveComment',[CommentController::class, 'saveComment'])->middleware('auth');
Route::get('/deleteComment/{id}',[CommentController::class, 'deleteComment'])->middleware('auth');
Route::get('/like/{image_id}',[LikeController::class, 'like'])->middleware('auth');
Route::get('/profile/{id}',[UserController::class, 'profile'])->middleware('auth');
Route::get('/deleteImage/{id}',[ImageController::class, 'deleteImage'])->middleware(('auth'));

require __DIR__.'/auth.php';
