<?php

namespace App\Jobs;

use App\Events\AccreditationProcessedEvent;
use App\Models\Accreditation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAccreditationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Accreditation $accreditation;

    public function __construct(Accreditation $accreditation)
    {
        $this->accreditation = $accreditation;
    }

    public function handle(): void
    {
        AccreditationProcessedEvent::dispatch($this->accreditation);
    }
}
