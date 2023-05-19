<?php

namespace App\Actions\Utilities;

use Lorisleiva\Actions\Concerns\AsAction;

class GenerateMailNumber
{
    use AsAction;

    public function handle(): string
    {
        return 'SK-'.date('Ymd').'-'.rand(1000, 9999);
    }
}
