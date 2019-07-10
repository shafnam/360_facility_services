<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Validator::extend('check_array', function ($attribute, $value, $parameters, $validator) {
        //     return count(array_filter($value, function($var) use ($parameters) { return ( $var && $var >= $parameters[0]); }));
        // });

        Validator::extend('check_array', function ($attribute, $value, $parameters, $validator) {
            foreach($value as $data){
                if(count($data)) return true;
            }
            return false;
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
