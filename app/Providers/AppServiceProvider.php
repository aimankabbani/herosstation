<?php

namespace App\Providers;

use App\Models\GlobalMenu;
use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use App\Models\Site;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }



    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        app()->singleton('currentSite', function () {

            $slug = request()->segment(2); // or however you detect it

            return Site::where('slug', $slug)->first();
        });

        View::composer('*', function ($view) {

            $site = app('currentSite');

            $cacheKey = 'menus_for_site_' . ($site?->id ?? 'global');

            $menus = cache()->remember($cacheKey, 3600, function () use ($site) {

                // try site menus first
                if ($site) {
                    $siteMenus = Menu::where('site_id', $site->id)
                        ->active()
                        ->get();

                    if ($siteMenus->isNotEmpty()) {
                        return $siteMenus;
                    }
                }

                // fallback → global menus (site_id NULL)
                return Menu::whereNull('site_id')
                    ->active()
                    ->get();
            });

            $view->with('globalMenus', $menus);
        });
    }
}
