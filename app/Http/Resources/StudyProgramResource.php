<?php

namespace App\Http\Resources;

use App\Models\Decree;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudyProgramResource extends JsonResource
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
            'degree' => $this->degree,
            'university' => $this->whenLoaded('university', fn () => UniversityResource::make($this->university)),
            'decrees' => $this->whenLoaded('decree'), fn() => DecreeResource::make($this->decree)
        ];
    }
}
