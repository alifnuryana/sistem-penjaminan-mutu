<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'unitable_type' => $this->unitable_type === 'App\Models\StudyProgram' ? 'Program Studi' : 'PT',
            'unitable' => $this->unitable_type === 'App\Models\StudyProgram' ? StudyProgramResource::make($this->unitable) : UniversityResource::make($this->unitable),
        ];
    }
}
