<?php

namespace App\Actions\StudyPrograms;

use App\Data\StudyProgramData;
use App\Models\StudyProgram;
use Lorisleiva\Actions\Concerns\AsAction;

class AddNewStudyProgram
{
    use AsAction;

    /**
     * Create a new study program.
     * @param StudyProgramData $data
     * @return StudyProgram
     */
    public function handle(StudyProgramData $data): StudyProgram
    {
        return StudyProgram::create($data->toArray());
    }
}