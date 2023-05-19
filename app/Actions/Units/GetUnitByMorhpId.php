<?php

namespace App\Actions\Units;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUnitByMorhpId
{
    use AsAction;

    public function handle(string $uuid): Model|Unit
    {
        return Unit::query()
            ->with([
                'unitable',
                'accreditations.decree',
                'accreditations.unit',
            ])
            ->where('unitable_id', '=', $uuid)
            ->firstOrFail();
    }
}
