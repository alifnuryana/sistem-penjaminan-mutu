<?php

namespace App\Actions\Accreditations;

use App\Models\Accreditation;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteAccreditation
{
    use AsAction;

    public function handle(string $uuid): void
    {
        $accreditation = Accreditation::where('id', '=', $uuid)->firstOrFail();

        $accreditation->delete();
    }
}
