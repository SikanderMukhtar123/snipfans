<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\tools;

class ViewServiceProvider extends ServiceProvider
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
        View::composer(['frontend.header', 'frontend.footer'], function ($view) {
            $DynamicTools = tools::where('status', '1')->orderBy('order', 'asc')->get();
            $view->with('toolsData', $DynamicTools);
        });
    }
}
