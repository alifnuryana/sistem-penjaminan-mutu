<?php

namespace App\Actions\Decree;

use App\Models\Decree;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchAllDecree
{
    use AsAction;

    public function handle(string $keyword, bool $paginated = false): Collection|LengthAwarePaginator
    {
        $keyword = ucwords($keyword);
        $query = Decree::query()
            ->with([
                'decreeable'
            ])
            ->where('name', 'like', "%{$keyword}%");

        if ($paginated) {
            return $query->paginate(10)
                ->withQueryString();
        }

        return $query->get();
    }
}
