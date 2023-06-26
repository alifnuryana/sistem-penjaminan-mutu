<?php

namespace App\Actions\Decree;

use App\Models\Decree;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllDecree
{
    use AsAction;

    public function handle(bool $paginated): Collection|LengthAwarePaginator
    {
        $query = Decree::query()
            ->with([
                'decreeable',
            ])
            ->orderBy('release_date');

        if ($paginated) {
            return $query->paginate(10)
                ->withQueryString();
        }

        return $query->get();
    }
}
