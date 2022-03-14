<?php

namespace App\Providers;

use App\Models\Setting;
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
        $settings = (object)[
            'email' => 'kkkkkkk',
            'phone' => '123456789',
            'fb_link' => 'kkkkkkkkkk',
            'tw_link' => 'kkkkkkkkkk',
            'insta_link' => 'kkkkkkkkkk',
            'yt_link' => 'kkkkkkkkkk',
            'about_app' => 'kkkkkkkkkk'
        ];
        view()->share(compact('settings'));
    }
}
