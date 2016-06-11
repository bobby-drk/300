<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('var', function($expression) {
            $regex = "/\((['\"])([\w_]+)\\1,\s*([^\)]+)\)/";
            return preg_replace($regex, '<?php $$2 = $3; ?>', $expression);
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
