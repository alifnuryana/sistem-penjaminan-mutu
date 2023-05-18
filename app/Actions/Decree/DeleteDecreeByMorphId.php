<?php

namespace App\Actions\Decree;

use App\Models\Decree;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteDecreeByMorphId
{
    use AsAction;

    /**
     * @param string $uuid
     * @return void
     */
    public function handle(string $uuid): void
    {
        Decree::query()
            ->where('decreeable_id', '=', $uuid)
            ->delete();
    }
}
