<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google\Client;


class GoogleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
  

    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            $client = new Client();
            $client->setClientId(env('GOOGLE_CLIENT_ID'));
            $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
            $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
            $client->addScope('https://www.googleapis.com/auth/gmail.send');
            return $client;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
