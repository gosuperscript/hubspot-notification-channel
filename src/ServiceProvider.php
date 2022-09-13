<?php

namespace DigitalRisks\Notifications;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use SevenShores\Hubspot\Factory;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('hubspot', function ($app) {
                return new Channels\HubspotChannel(
                    new Factory([
                        'key' => $this->app['config']['services.hubspot.app_access_token'],
                        'oauth2' => true,
                    ])
                );
            });
        });
    }
}
