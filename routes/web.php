<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\DashboarController;
use App\Http\Controllers\KtgrUserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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
Route::resource('/home', HomeController::class);

Route::get('/', function () {
    return view(
        'home',
        [
            "title" => "Home"
        ]
    );
});

// Route::get('/post/user', function () {
//     return view(
//         'post.user',
//         [
//             "title" => "post"
//         ]
//     );
// });

Route::resource('/kategori', KtgrUserController::class,);
// post
Auth::routes();


Route::group(['middleware' => ['auth',]], function () {
    Route::resource('/dashboard', DashboarController::class);
    Route::resource('/kategoris', KategoriController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/post', PostController::class);
    Route::resource('/roles', RoleController::class);
});

// Route::group(['middleware' => ['auth']], function () {
//     Route::resource('/profil', ProfilController::class);
//     Route::get('/create/post', [PostController::class, 'userCreate'])->name('userCreate');
// });


Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});