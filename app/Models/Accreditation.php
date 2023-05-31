<?php

namespace App\Models;

use App\Enums\AccreditationGrade;
use App\Enums\AccreditationStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Accreditation extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'code',
        'grade',
        'status',
        'unit_id',
    ];

    protected $casts = [
        'grade' => AccreditationGrade::class,
        'status' => AccreditationStatus::class,
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function decree(): MorphOne
    {
        return $this->morphOne(Decree::class, 'decreeable');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
