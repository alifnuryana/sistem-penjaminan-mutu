<?php

namespace App\Listeners;

use App\Events\AccreditationProcessedEvent;
use App\Notifications\NewAccreditationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyNewAccreditationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AccreditationProcessedEvent $event): void
    {
        $event->accreditation->unit->notify(new NewAccreditationNotification());
    }
}
