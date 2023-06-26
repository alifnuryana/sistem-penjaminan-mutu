<?php

namespace App\Actions\Universities;

use App\Data\UniversityData;
use App\Models\University;
use Lorisleiva\Actions\Concerns\AsAction;

class AddNewUniversity
{
    use AsAction;

    /**
     * Create a new university.
     */
    public function handle(UniversityData $data): University
    {
        return University::create($data->toArray());
    }
}
