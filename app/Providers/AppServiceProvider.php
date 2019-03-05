<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Golf;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('email_player_available', function ($attribute, $value, $parameters, $validator) {
            $input = $validator->getData();
            $db = new Golf;
            $player = $db->getPlayerByEmail($input['email']);
            
            if ( $player )
            {
                return false;
            }
            
            return true;
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
