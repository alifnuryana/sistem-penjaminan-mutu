<?php

namespace App\Providers;

use App\Events\AccreditationProcessedEvent;
use App\Events\RemainderAccreditationProcessedEvent;
use App\Listeners\NotifyNewAccreditationListener;
use App\Listeners\NotifyUnitListener;
use App\Listeners\PopulateNotificationScheduleListener;
use App\Listeners\UpdateNotificationStatusListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AccreditationProcessedEvent::class => [
            PopulateNotificationScheduleListener::class,
            NotifyNewAccreditationListener::class,
        ],
        RemainderAccreditationProcessedEvent::class => [
            NotifyUnitListener::class,
            UpdateNotificationStatusListener::class,
        ]
    ];

    public function boot(): void
    {
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
