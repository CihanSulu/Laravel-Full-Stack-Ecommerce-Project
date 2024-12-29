<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $url = \App\Models\Ayarlar::first()->panel_url;
        $tel = \App\Models\Ayarlar::first()->site_tel1;
        \Session::put('url', $url);
        view()->share(['url'=>$url,'site'=>'Kanmaz Pet','tel'=>$tel]);
    }
}
