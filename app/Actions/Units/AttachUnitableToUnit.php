<?php

namespace App\Actions\Units;

use App\Data\UnitData;
use App\Models\StudyProgram;
use App\Models\University;
use Lorisleiva\Actions\Concerns\AsAction;

class AttachUnitableToUnit
{
    use AsAction;

    /**
     * @param University|StudyProgram $unitabel
     * @param UnitData $data
     * @return void
     */
    public function handle(University|StudyProgram $unitabel, UnitData $data): void
    {
        $unitabel->unit()->create($data->toArray());
    }
}
