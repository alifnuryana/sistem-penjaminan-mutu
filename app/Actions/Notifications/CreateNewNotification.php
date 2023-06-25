<?php

namespace App\Actions\Notifications;

use App\Enums\NotificationStatus;
use App\Models\Accreditation;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateNewNotification
{
    use AsAction;

    public function handle(Accreditation $accreditation, $dueDate)
    {
        $accreditation->notifications()->create([
            'due_date' => $dueDate,
            'status' => NotificationStatus::Scheduled,
        ]);
    }
}
