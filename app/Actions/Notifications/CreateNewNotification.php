<?php

namespace App\Actions\Notifications;

use App\Enums\NotificationStatus;
use App\Models\Accreditation;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateNewNotification
{
    use AsAction;

    public function handle(Accreditation $accreditation, int $daysBeforeValidityDate): void
    {
        if ($accreditation->decree->validity_date) {
            $accreditation->notifications()->create([
                'due_date' => $accreditation->decree->validity_date->subDays($daysBeforeValidityDate),
                'status' => NotificationStatus::Pending,
            ]);
        }
    }
}
