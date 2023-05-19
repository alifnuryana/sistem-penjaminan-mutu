<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class StudyProgram extends Model
{
    use HasUuids;

    protected $fillable = [
        'degree',
        'university_id',
    ];

    public function unit(): MorphOne
    {
        return $this->morphOne(Unit::class, 'unitable');
    }

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function decree(): MorphOne
    {
        return $this->morphOne(Decree::class, 'decreeable');
    }
}
