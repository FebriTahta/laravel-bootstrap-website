<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\UserController;
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
use App\Http\Controllers\AlumniController;
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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'CheckRole:admin,super_admin']], function () {
    Route::get('/admin-dashboard', [DashboardController::class,'index'])->name('admin-dashboard');

    Route::controller(UserController::class)->group(function(){
        Route::get('/admin-users','index')->name('admin-users');
        Route::post('/admin-users-update','update');
    }); 

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
        Route::get('/admin-socialmedia','index')->name('admin-socialmedia');
        Route::get('/admin-socialmedia-create','create');
        Route::post('/admin-socialmedia-store','store');
        Route::get('/admin-socialmedia-edit/{id}','edit');
        Route::post('/admin-socialmedia-update/{id}','update');
        Route::get('/admin-socialmedia-destroy/{id}','destroy');
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

    Route::controller(AlumniController::class)->group(function(){
        Route::get('/admin-alumni','index');
        Route::get('/admin-alumni-destroy/{id}','destroy');
        Route::get('/admin-alumni-edit/{id}','edit');
        Route::post('/admin-audit-ulasan-alumni','audit_ulasan_alumni')->name('admin.audit_ulasan');
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
    Route::get('/ulasan','ulasan')->name('ulasan');
    Route::get('/alumni','alumni')->name('alumni');
    Route::get('/alumni/search','alumni_search')->name('alumni.search');

    // 
    Route::get('/migrate-backup','migrate_backup');
    Route::get('/tes','backup');
    Route::post('/import-migrate-backup','import')->name('import.backup');
});

Route::controller(AlumniController::class)->group(function(){
    Route::post('/registrasi/alumni','store')->name('store_registrasi_alumni');
});

Route::controller(UlasanController::class)->group(function(){
    Route::post('/submit-ulasan','store')->name('submit_ulasan');
});

Route::controller(SitemapController::class)->group(function(){
    Route::get('sitemap.xml','index')->name('sitemap');
});