<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class StudyProgramData extends Data
{
    public function __construct(
        public string $degree,
        public string $university_id,
    )
    {
    }
}
