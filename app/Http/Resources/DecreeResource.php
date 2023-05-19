<?php

namespace App\Http\Resources;

use App\Actions\Units\GetUnitByAccreditationId;
use App\Actions\Units\GetUnitByMorhpId;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DecreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'file_path' => $this->file_path,
            'size' => $this->size,
            'release_date' => $this->release_date,
            'validity_date' => $this->validity_date,
            'type' => $this->type,
            'decreeable' => $this->whenLoaded('decreeable', function () {
                if ($this->decreeable_type === 'App\Models\StudyProgram' || $this->decreeable_type === 'App\Models\University') {
                    return UnitResource::make(GetUnitByMorhpId::run($this->decreeable_id));
                } else {
                    return UnitResource::make(GetUnitByAccreditationId::run($this->decreeable_id));
                }
            }),
        ];
    }
}
