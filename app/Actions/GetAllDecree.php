<?php

namespace App\Actions;

use App\Models\Decree;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllDecree
{
    use AsAction;

    public function handle()
    {
        return Decree::all()->map(function ($decree){
            return[
                'name' => $decree->name,
                'code' => $decree->code,
                'type' => $decree->type,
                'url' => Storage::url($decree->file_path),
                'path' => $decree->file_path,
                'validity_date' => $decree->validity_date,
                'current_date' => (new \DateTime())->format('Y-m-d')
            ];
        })->sortByDesc('validity_date')->values()->all();
    }
}
