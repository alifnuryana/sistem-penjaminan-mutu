<?php

namespace App\Actions\Accreditations;

use App\Models\Accreditation;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAccreditationById
{
    use AsAction;

    public function handle(string $uuid): Accreditation
    {
        return Accreditation::query()
            ->where('id', '=', $uuid)
            ->first();
    }
}
