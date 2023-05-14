<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccreditationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @return array<string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'grade' => $this->grade,
            'status' => $this->status,
            'due_date' => $this->due_date,
            'unit' => UnitResource::make($this->unit),
        ];
    }
}
