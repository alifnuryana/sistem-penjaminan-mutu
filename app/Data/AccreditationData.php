<?php

namespace App\Data;

use App\Enums\AccreditationGrade;
use App\Enums\AccreditationStatus;
use Carbon\Carbon;
use Spatie\LaravelData\Data;

class AccreditationData extends Data
{
    public function __construct(
        public string $code,
        public AccreditationGrade $grade,
        public AccreditationStatus $status,
        public Carbon $due_date,
        public string $unit_id,
    ) {
    }
}
