<?php

namespace App\Jobs;

use App\Events\RemainderAccreditationProcessedEvent;
use App\Models\Accreditation;
use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessRemainderAccreditationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Accreditation $accreditation;
    public Notification $notification;

    public function __construct(Accreditation $accreditation, Notification $notification)
    {
        $this->accreditation = $accreditation;
        $this->notification = $notification;
    }

    public function handle(): void
    {
        RemainderAccreditationProcessedEvent::dispatch($this->accreditation, $this->notification);
    }
}
