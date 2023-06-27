<?php

namespace App\Listeners;

use App\Enums\NotificationStatus;
use App\Events\AccreditationProcessedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PopulateNotificationScheduleListener
{

    public function __construct()
    {
        //
    }

    public function handle(AccreditationProcessedEvent $event): void
    {
        $dataDueDate = config('app.due_dates');

        foreach ($dataDueDate as $dueDate) {
            if ($event->accreditation->decree->validity_date->subDays($dueDate)->isBefore(now())) {
                continue;
            } else {
                $event->accreditation->notifications()->create([
                    'status' => NotificationStatus::Scheduled,
                    'due_date' => $event->accreditation->decree->validity_date->subDays($dueDate),
                ]);
            }
        }
    }
}
