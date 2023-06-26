<?php

namespace App\Listeners;

use App\Events\RemainderAccreditationProcessedEvent;
use App\Notifications\RemainderUnitNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUnitListener
{
    public function __construct()
    {
        //
    }

    public function handle(RemainderAccreditationProcessedEvent $event): void
    {
        $event->accreditation->unit->notify(new RemainderUnitNotification($event->accreditation));
    }
}
