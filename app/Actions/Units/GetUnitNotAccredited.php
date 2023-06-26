<?php

namespace App\Actions\Units;

use App\Enums\AccreditationStatus;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUnitNotAccredited
{
    use AsAction;

    /**
     * Get all units that are not accredited.
     */
    public function handle(): Collection
    {
        return Unit::query()
            ->with(['accreditations', 'unitable'])
            ->whereDoesntHave('accreditations', function ($query): void {
                $query->where('status', '=', AccreditationStatus::Active);
            })
            ->get();
    }
}
