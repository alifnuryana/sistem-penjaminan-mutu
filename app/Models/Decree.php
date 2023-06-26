<?php

namespace App\Models;

use App\Enums\DecreeType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Decree extends Model
{
    use HasUuids;

    protected $fillable = [
        'code', 'name', 'decreeable_type', 'decreeable_id', 'file_path', 'type', 'size', 'validity_date', 'release_date',
    ];

    protected $casts = [
        'validity_date' => 'date',
        'release_date' => 'date',
        'type' => DecreeType::class,
    ];

    public function decreeable(): MorphTo
    {
        return $this->morphTo();
    }
}
