<?php

namespace App\Actions\Units;

use App\Actions\Decree\DeleteDecreeByMorphId;
use App\Actions\StudyPrograms\DeleteStudyProgramById;
use App\Models\Unit;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteUnitById
{
    use AsAction;

    /**
     * Delete unit by id.
     */
    public function handle(string $uuid): void
    {
        $unit = GetUnitById::run($uuid);

        if ($unit->unitable_type === 'App\Models\StudyProgram') {
            // Menghapus SK Pendirian
            DeleteDecreeByMorphId::run($unit->unitable_id);
            // Menghapus SK Akreditasi
            foreach ($unit->accreditations as $accreditation) {
                DeleteDecreeByMorphId::run($accreditation->id);
            }

            // Hapus StudyProgram
            DeleteStudyProgramById::run($unit->unitable_id);

            $unit->delete();
        }
    }
}
