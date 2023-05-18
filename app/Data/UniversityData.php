<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UniversityData extends Data
{
    public function __construct(
        public string $address,
    )
    {
    }
}
