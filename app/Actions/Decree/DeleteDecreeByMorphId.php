<?php

namespace App\Actions\Decree;

use App\Models\Decree;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteDecreeByMorphId
{
    use AsAction;

    public function handle(string $uuid): void
    {
        $decree = Decree::query()
            ->where('decreeable_id', '=', $uuid)
            ->first();

        $decree->delete();
    }
}
