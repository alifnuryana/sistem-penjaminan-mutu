<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Decree extends Model
{
    use HasUuids;

    protected $fillable = [
        'code', 'name', 'decreeable_type', 'decreeable_id', 'file_path', 'type', 'size', 'release_date', 'validity_date'
    ];

    public function decreeable() : MorphTo
    {
        return $this->morphTo();
    }

}
