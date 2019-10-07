<?php

namespace App\Providers;


use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Notification;
use Illuminate\Support\Facades\View;
use Route;

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
        Schema::defaultStringLength(191);
         $url=$this->app->request->getRequestUri();
         if(stripos($url,'welcome')){

            $notifications = Notification::where('type','customer')->get();

            View::share('notifications', $notifications);
        }
        elseif(stripos($url,'parista')){

            $notifications = Notification::where('type','parista')->get();
            View::share('notifications', $notifications);
        }
        else
        {
            $notifications = Notification::where('type','admin')->get();
            View::share('notifications', $notifications);
        }
    }
}
