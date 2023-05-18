<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UnitData extends Data
{
    public function __construct(
        public string $name,
        public string $code,
        public string $email,
        public string $unitable_type,
    ) {
    }
}
