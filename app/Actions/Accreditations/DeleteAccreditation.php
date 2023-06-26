<?php

namespace App\Actions\Accreditations;

use App\Actions\Decree\DeleteDecreeByMorphId;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteAccreditation
{
    use AsAction;

    public function handle(string $uuid): void
    {
        $accreditation = GetAccreditationById::run($uuid);

        // Delete SK Akreditasi
        DeleteDecreeByMorphId::run($uuid);

        $accreditation->delete();
    }
}
