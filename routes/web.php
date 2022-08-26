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
Route::resource('/home',HomeController::class);

Route::get('/', function () {
    return view('home',[
        "title" => "Home"
    ]);
});

Route::get('/tes', function () {
    return view('tags/user',[
        "title" => "Tag"
    ]);
});

Route::get('/kategori', [KtgrUserController::class,'index']
    
);

// post
Route::get('/posts', [PostController::class,'index']
    
);


Route::group(['middleware' => ['auth', 'role:admin']], function(){
    Route::get('/dashboard',[DashboarController::class, 'index']);
    Route::resource('/kategoris',KategoriController::class);
    Route::resource('/tags',TagController::class);

});

Auth::routes();

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
}); 

