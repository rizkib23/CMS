<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\DashboarController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\KtgrUserController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MetaController;

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
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::get('/posts/{slug}', [HomeController::class, 'showPostDetail'])->name('post-detail');

Route::get('/kategori', [HomeController::class, 'listKategori'])->name('kategori');

Route::get('/search', [HomeController::class, 'searchPosts'])->name('search-post');

Route::get('/kategori/{slug}', [HomeController::class, 'showPostByKategori'])->name('post-kategori');

Route::get('/tag/{slug}', [HomeController::class, 'showPostByTag'])->name('post-tag');

// Route::get('/tai', function () {
//     return view('tags/tags_user',[
//         "title" => "Tag"
//     ]);
// });

// Route::get('/login', function () {
//     return view('login/login1',[
//         "title" => "Login"
//     ]);
// });

// Route::resource('/kategori', KtgrUserController::class,);
// post
Auth::routes();

Route::get('tags/delete/{id}', [TagController::class, 'destroy']);
Route::group(['middleware' => ['auth',]], function () {
    Route::resource('/dashboard', DashboarController::class);
    Route::resource('/kategoris', KategoriController::class);
    // tags
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::post('/tags/{id}/update', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{id}/delete', [TagController::class, 'destroy'])->name('tags.destroy');
    // 
    Route::resource('/post', PostController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/profil', ProfilController::class);
    Route::resource('/pengumuman', PengumumanController::class);
    Route::resource('/komen', KomentarController::class);
});
Route::get('lihat', [PengumumanController::class, 'coba'])->name('coba');

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::resource('/meta', MetaController::class);