<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Using class based composers...
        View::composer('layouts_fe.raw', function ($view) {
            $view->with('menus', Menu::where('menu_status', 1)->with('submenu',function($q){
                $q->where('submenu_status',1);
            })->withCount('submenu')->get());
        });

    }
}
