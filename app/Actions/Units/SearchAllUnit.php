<?php

namespace App\Actions\Units;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchAllUnit
{
    use AsAction;

    public function handle(bool $paginated, string $keyword): Collection|LengthAwarePaginator
    {
        $keyword = ucwords($keyword);
        $query = Unit::query()
            ->with([
                'unitable',
            ])
            ->where('name', 'like', "%{$keyword}%");

        if ($paginated) {
            return $query->paginate(10)
                ->withQueryString();
        }

        return $query->get();
    }
}
