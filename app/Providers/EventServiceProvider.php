<?php

namespace App\Providers;

use App\Events\CheckGuest;
use App\Events\EventRegisterEmployee;
use App\Listeners\CheckGuests;
use App\Listeners\RegisterEmployee;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CheckGuest::class => [
            CheckGuests::class,
        ],
        EventRegisterEmployee::class => [
            RegisterEmployee::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
