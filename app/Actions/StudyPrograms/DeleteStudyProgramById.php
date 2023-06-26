<?php

namespace App\Actions\StudyPrograms;

use App\Models\StudyProgram;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteStudyProgramById
{
    use AsAction;

    /**
     * Delete study program by id.
     */
    public function handle(string $uuid): void
    {
        $studyProgram = StudyProgram::query()
            ->where('id', '=', $uuid)
            ->first();

        $studyProgram->delete();
    }
}
