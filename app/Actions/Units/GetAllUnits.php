<?php

namespace App\Actions\Units;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllUnits
{
    use AsAction;

    public function handle(bool $paginated = false): Collection|LengthAwarePaginator
    {
        $query = Unit::query()
            ->with([
                'unitable',
            ]);

        if ($paginated) {
            return $query->paginate(10)
                ->withQueryString();
        }

        return $query->get();
    }
}
