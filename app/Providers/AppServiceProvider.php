<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('view')->composer('layouts.app', function ($view) {
            $action = app('request')->route()->getAction();

            $controller = class_basename($action['controller']);

            list($controller, $action) = explode('@', $controller);

            $blog_show = $controller == 'BlogController' && $action == 'show';
        
            $view->with(compact('controller', 'action', 'blog_show'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
