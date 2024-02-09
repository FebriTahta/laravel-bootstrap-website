<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SocialmediaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('layouts_fe.raw');
// });
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'CheckRole:admin,super_admin']], function () {
    Route::get('/admin-dashboard', [DashboardController::class,'index'])->name('admin-dashboard');

    Route::controller(MenuController::class)->group(function(){
        Route::get('/admin-menus', 'index')->name('admin-menus');
        Route::get('/admin-menu-create', 'create');
        Route::post('/admin-menu-store', 'store');
        Route::get('/admin-menu-edit/{id}','edit');
        Route::post('/admin-menu-update/{id}','update');
        Route::get('/admin-menu-destroy/{id}','destroy');
    });

    Route::controller(SubmenuController::class)->group(function(){
        Route::get('/admin-submenus','index')->name('admin-submenus');
        Route::get('/admin-submenu-create','create');
        Route::post('/admin-submenu-store','store');
        Route::get('/admin-submenu-edit/{id}','edit');
        Route::post('/admin-submenu-update/{id}','update');
        Route::get('/admin-submenu-destroy/{id}','destroy');
    });

    Route::controller(KontenController::class)->group(function(){
        Route::get('/admin-konten','index')->name('admin-konten');
        Route::get('/admin-konten-create','create');
        Route::post('/admin-konten-store','store');
        Route::get('/admin-konten-edit/{id}','edit');
        Route::post('/admin-konten-update/{id}','update');
        Route::get('/admin-konten-destroy/{id}','destroy');
    });

    Route::controller(KategoriController::class)->group(function(){
        Route::get('/admin-kategori','index')->name('admin-kategori');
        Route::get('/admin-kategori-create','create');
        Route::post('/admin-kategori-store','store');
        Route::get('/admin-kategori-edit/{id}','edit');
        Route::post('/admin-kategori-update/{id}','update');
        Route::get('/admin-kategori-destroy/{id}','destroy');
    });

    Route::controller(PostController::class)->group(function(){
        Route::get('/admin-post','index')->name('admin-post');
        Route::get('/admin-post-create/{konten_id}','create');
        Route::post('/admin-post-store','store');
        Route::get('/admin-post-edit/{id}','edit');
        Route::post('/admin-post-update/{id}','update');
        Route::get('/admin-post-destroy/{id}','destroy');
    });

    Route::controller(SocialmediaController::class)->group(function(){
        Route::post('/admin-sosmed-store','sstore');
    });

    Route::controller(ImageController::class)->group(function(){
        Route::get('/admin-image-destroy/{id}','destroy');
    });

    Route::controller(FileController::class)->group(function(){
        Route::get('/admin-file-destroy/{id}','destroy');
    });

    Route::controller(ProfileController::class)->group(function(){
        Route::get('/admin-setting','index');
        Route::post('/admin-setting-store','store');
    });
});
// FE
Route::controller(LandingController::class)->group(function(){
    Route::get('/','index');
});

Route::controller(PageController::class)->group(function(){
    Route::get('/post/{konten_slug}','datalist');
    Route::get('/post/{konten_slug}/search','search')->name('post.search');
    Route::get('/post/{konten_slug}/{post_slug}','detaildata')->name('post.detaildata');
    Route::get('/search/post','global_search')->name('global_post.search');
    Route::get('/registrasi-alumni','registrasi_alumni')->name('registrasi.alumni');


    // 
    Route::get('/migrate-backup','migrate_backup');
    Route::get('/tes','backup');
    Route::post('/import-migrate-backup','import')->name('import.backup');
});


