<?php

namespace App\Listeners;

use App\Enums\NotificationStatus;
use App\Events\RemainderAccreditationProcessedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateNotificationStatusListener
{
    public function __construct()
    {
        //
    }

    public function handle(RemainderAccreditationProcessedEvent $event): void
    {
        $event->notification->update([
            'status' => NotificationStatus::Sended,
        ]);
    }
}
