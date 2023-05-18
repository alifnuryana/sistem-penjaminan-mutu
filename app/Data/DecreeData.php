<?php

namespace App\Data;

use App\Enums\DecreeType;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class DecreeData extends Data
{
    public function __construct(
        public string          $code,
        public string          $name,
        public string          $file_path,
        public int             $size,
        public DecreeType      $type,
        public string          $decreeable_type,
        public Carbon          $release_date,
        public Carbon|Optional $validity_date,
    )
    {
    }
}
