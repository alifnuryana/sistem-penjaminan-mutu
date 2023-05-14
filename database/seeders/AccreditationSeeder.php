<?php

namespace Database\Seeders;

use App\Enums\AccreditationStatus;
use App\Models\Accreditation;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccreditationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        Unit::all()->each(function (Unit $unit) : void {
            Accreditation::factory()->create([
                'status' => AccreditationStatus::Active,
                'unit_id' => $unit->id,
            ]);
        });
    }
}
