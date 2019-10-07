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
        if (Schema::hasTable('notifications')) {
            $url=$this->app->request->getRequestUri();
            if(stripos($url,'welcome')){

               $notifications = Notification::where('type','customer')->orderBy('id','desc')->limit(100)->get();
               $count =Notification::where('type','customer')->where('status',false)->count();
               View::share(['notifications'=>$notifications,'count'=>$count]);
           }
           elseif(stripos($url,'parista')){

               $notifications = Notification::where('type','parista')->orderBy('id','desc')->limit(100)->get();
               $count =Notification::where('type','parista')->where('status',false)->count();

               View::share($data=['notifications'=>$notifications,'count'=>$count]);
           }
           else
           {
               $notifications = Notification::where('type','admin')->orderBy('id','desc')->limit(100)->get();
               $count =Notification::where('type','admin')->where('status',false)->count();

               View::share(['notifications'=> $notifications,'count'=>$count]);
           }

        }

    }
}
