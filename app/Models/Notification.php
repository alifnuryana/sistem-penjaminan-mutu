<?php

namespace App\Models;

use App\Enums\NotificationStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasUuids;

    protected $fillable = [
        'due_date',
        'status',
        'accreditation_id'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'status' => NotificationStatus::class,
    ];

    public function accreditation()
    {
        return $this->belongsTo(Accreditation::class);
    }
}
