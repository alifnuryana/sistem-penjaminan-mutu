<?php

namespace App\Actions\Notifications;

use App\Enums\NotificationStatus;
use App\Models\Accreditation;
use Lorisleiva\Actions\Concerns\AsAction;

class PopulateScheduledNotification
{
    use AsAction;

    public function handle(Accreditation $accreditation)
    {
        $dataDueDate = config('app.due_dates');

        foreach ($dataDueDate as $dueDate) {
            if ($accreditation->decree->validity_date->subDays($dueDate)->isBefore(now())) {
                continue;
            } else {
                CreateNewNotification::run($accreditation, $accreditation->decree->validity_date->subDays($dueDate));
            }
        }
    }
}
