<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
        //GeneaLabs\LaravelSocialiter\Providers\ServiceProvider::class,

        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\Instagram\InstagramExtendSocialite::class.'@handle',
        ],

        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\Apple\AppleExtendSocialite::class.'@handle',
        ],
    ];
}
