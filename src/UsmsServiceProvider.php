<?php

namespace Urhitech\Usmsgh;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class UsmsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(Usms::class, function ($app) {
            return new Usms();
        });

        $this->app->bind(USmsChannel::class, function ($app) {
            return new USmsChannel(
                $this->app->make(Usms::class),
                $this->app['config']['services.usmsgh.sender_endpoint'],
                $this->app['config']['services.usmsgh.api_token'],
                $this->app['config']['services.usmsgh.sender_id'],
                $this->app['config']['services.usmsgh.universal_to']
            );
        });

        Notification::resolved(function (ChannelManager $service) {
            $service->extend('usmsgh', function ($app) {
                return $this->app->make(USmsChannel::class);
            });
        });
    }
}
