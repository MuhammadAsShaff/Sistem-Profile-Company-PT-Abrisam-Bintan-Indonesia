<?php

namespace App\Providers;

use App\Mail\Transports\GmailApiTransport;
use Google_Client;
use Google\Service\Gmail as Google_Service_Gmail;
use Illuminate\Mail\MailManager;
use Illuminate\Support\ServiceProvider;

class GmailApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @param MailManager $mailManager
     * @return void
     */
    public function boot(MailManager $mailManager)
    {
        // Extend the Laravel mailer to add a custom Gmail API driver
        $mailManager->extend('gmail-api', function () {
            // Initialize the Google Client
            $client = new Google_Client();
            $client->setAuthConfig(storage_path(env('GOOGLE_CREDENTIALS_PATH'))); // Pastikan file kredensial JSON ada di lokasi ini
            $client->addScope(Google_Service_Gmail::MAIL_GOOGLE_COM);
            $client->setAccessType('offline');
            $client->setPrompt('select_account consent');

            // Menggunakan Refresh Token jika ada
            if ($refreshToken = env('GOOGLE_REFRESH_TOKEN')) {
                $client->fetchAccessTokenWithRefreshToken($refreshToken);
            }

            // Buat instance Google Gmail Service
            $gmailService = new Google_Service_Gmail($client);

            // Kembalikan transport khusus yang akan digunakan Laravel Mail
            return new GmailApiTransport($gmailService);
        });
    }
}
