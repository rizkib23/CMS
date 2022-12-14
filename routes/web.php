<?php

use App\Http\Controllers\DashboarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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
// user interface
Route::get('/', function () {
    return view('home', [
        "title" => "Home"
    ]);
});

Route::resource('/kategoris',KategoriController::class);

Route::get('/tai', function () {
    return view('tags/tags_user',[
        "title" => "Tag"
    ]);
});

// Route::get('/login', function () {
//     return view('login/login1',[
//         "title" => "Login"
//     ]);
// });

// Route::get('/daftar', function () {
//     return view('login/formulir',[
//         "title" => "Login"
//     ]);
// });

// post
Route::get('/posts', [PostController::class,'index']
    
);

// Route::get('/posts', [PostController::class,'show']
    
// );

// admin interface
// Route::get('/dashboard', function () {
//     return view('layouts/dashboard',[
//         "title" => "Dashboard"
//     ]);
// });

// tags
// Route::get('/tag',[TagController::class, 'index']);
// Route::POST('/tag',[TagController::class, 'store']);
// Route::put('/tag/{id}', [TagController::class,'update']);
Route::resource('/tags',TagController::class);

// tag
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest') ;
Route::POST('/login',[LoginController::class, 'authenticate']);
Route::POST('/logout',[LoginController::class, 'logout']);

Route::get('/register',[RegisterController::class, 'index'])->middleware('guest');
Route::POST('/register',[RegisterController::class, 'store']);

Route::get('/dashboard',[DashboarController::class, 'index'])->middleware('auth');