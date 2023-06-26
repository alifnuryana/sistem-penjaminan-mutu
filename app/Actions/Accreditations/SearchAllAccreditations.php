<?php

namespace App\Actions\Accreditations;

use App\Models\Accreditation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchAllAccreditations
{
    use AsAction;

    /**
     * Search all accreditations.
     */
    public function handle(string $keyword = '', bool $paginated = false): Collection|LengthAwarePaginator
    {
        $keyword = ucwords($keyword);

        $query = Accreditation::query()
            ->with([
                'unit.unitable',
                'decree',
            ])
            ->whereHas('unit', function ($query) use ($keyword) {
                return $query
                    ->where('code', 'like', "%{$keyword}%")
                    ->orWhere('name', 'like', "%{$keyword}%");
            });

        if ($paginated) {
            return $query->paginate(10)
                ->withQueryString();
        }

        return $query->get();
    }
}
