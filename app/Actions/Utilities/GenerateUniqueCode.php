<?php

namespace App\Actions\Utilities;

use Lorisleiva\Actions\Concerns\AsAction;

class GenerateUniqueCode
{
    use AsAction;

    /**
     * Generate unique code.
     * @param string $prefix
     * @param int $length
     * @return string
     */
    public function handle(string $prefix, int $length = 10): string
    {
        $code = $prefix;
        $code .= mb_strtoupper(mb_substr(md5(uniqid((string) rand(), TRUE)), 0, $length - mb_strlen($prefix)));

        return $code;
    }
}
