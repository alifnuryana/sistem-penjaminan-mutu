<?php

namespace App\Actions\Units;

use App\Models\Unit;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUnitById
{
    use AsAction;

    /**
     * Get unit by id
     * @param string $uuid
     * @return Unit
     */
    public function handle(string $uuid): Unit
    {
        return Unit::query()
            ->where('id', '=', $uuid)
            ->first();
    }
}
