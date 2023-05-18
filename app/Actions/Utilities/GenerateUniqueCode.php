<?php

namespace App\Actions\Utilities;

use Lorisleiva\Actions\Concerns\AsAction;

class GenerateUniqueCode
{
    use AsAction;

    /**
     * Generate new unique code.
     * @param string $prefix
     * @return string
     */
    public function handle(string $prefix): string
    {
        return $prefix . '-' . date('Ymd') . '-' . mb_substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 5);
    }
}
