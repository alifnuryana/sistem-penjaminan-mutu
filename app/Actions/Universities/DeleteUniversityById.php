<?php

namespace App\Actions\Universities;

use App\Models\University;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteUniversityById
{
    use AsAction;

    public function handle(string $uuid): void
    {
        $university = University::query()
            ->where('id', '=', $uuid)
            ->first();

        $university->delete();
    }
}
