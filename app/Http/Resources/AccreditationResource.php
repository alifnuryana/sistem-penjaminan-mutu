<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccreditationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'grade' => $this->grade,
            'status' => $this->status,
            'unit' => $this->whenLoaded('unit', fn () => UnitResource::make($this->unit)),
            'decree' => $this->whenLoaded('decree', fn () => DecreeResource::make($this->decree)),
        ];
    }
}
