<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Unit extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'code',
        'name',
        'email',
        'unitable_id',
        'unitable_type',
    ];

    public function unitable() : MorphTo
    {
        return $this->morphTo();
    }
}
