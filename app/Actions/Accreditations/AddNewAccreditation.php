<?php

namespace App\Actions\Accreditations;

use App\Data\AccreditationData;
use App\Models\Accreditation;
use Lorisleiva\Actions\Concerns\AsAction;

class AddNewAccreditation
{
    use AsAction;

    public function handle(AccreditationData $data): Accreditation
    {
        return Accreditation::query()
            ->create($data->toArray());
    }
}
