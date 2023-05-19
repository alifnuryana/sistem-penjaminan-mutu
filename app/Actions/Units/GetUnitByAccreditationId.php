<?php

namespace App\Actions\Units;

use App\Models\Accreditation;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUnitByAccreditationId
{
    use AsAction;

    public function handle(string $uuid)
    {
        return Accreditation::query()
            ->where('id', '=', $uuid)
            ->firstOrFail()
            ->unit;
    }
}
