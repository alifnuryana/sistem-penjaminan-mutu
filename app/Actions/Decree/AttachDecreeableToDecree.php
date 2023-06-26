<?php

namespace App\Actions\Decree;

use App\Data\DecreeData;
use App\Models\Accreditation;
use App\Models\StudyProgram;
use App\Models\University;
use Lorisleiva\Actions\Concerns\AsAction;

class AttachDecreeableToDecree
{
    use AsAction;

    public function handle(StudyProgram|University|Accreditation $decreeable, DecreeData $data): void
    {
        $decreeable->decree()->create($data->toArray());
    }
}
