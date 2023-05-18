<?php

namespace App\Actions\Accreditations;

use App\Models\Accreditation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllAccreditations
{
    use AsAction;

    /**
     * Get all accreditations.
     */
    public function handle(bool $paginated = false): Collection|LengthAwarePaginator
    {
        $query = Accreditation::query()
            ->with([
                'unit.unitable',
            ])
            ->orderBy('due_date');

        if ($paginated) {
            return $query->paginate(10)
                ->withQueryString();
        }

        return $query->get();
    }
}
