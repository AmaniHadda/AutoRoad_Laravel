<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class CustomGuzzleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Create a HandlerStack
        $handler = HandlerStack::create();

        // Add a middleware to specify the CA file
        $handler->push(Middleware::mapRequest(function ($request) {
            // Specify the path to the CA certificate bundle file
            return $request->withCert(storage_path('certs/cacert.pem'));
        }));

        // Create the Guzzle client with the custom handler
        $client = new Client(['handler' => $handler]);

        // Bind the Guzzle client to the service container
        $this->app->instance(Client::class, $client);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
