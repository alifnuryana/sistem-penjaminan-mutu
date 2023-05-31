<?php

namespace App\Models;

use App\Enums\NotificationStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasUuids;

    protected $guarded = [];

    protected $casts = [
        'due_date' => 'date',
        'status' => NotificationStatus::class,
    ];

    public function accreditation(): BelongsTo
    {
        return $this->belongsTo(Accreditation::class);
    }
}
