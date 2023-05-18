<?php

namespace Database\Seeders;

use App\Actions\Decree\AttachDecreeableToDecree;
use App\Actions\Utilities\GenerateUniqueCode;
use App\Data\DecreeData;
use App\Enums\AccreditationStatus;
use App\Enums\DecreeType;
use App\Models\Accreditation;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AccreditationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::all()->each(function (Unit $unit): void {
            $accreditation = Accreditation::factory()->create([
                'status' => AccreditationStatus::Active,
                'unit_id' => $unit->id,
            ]);

            $data = DecreeData::from([
                'code' => GenerateUniqueCode::run('DOC', 10),
                'name' => 'SK Akreditasi '.$accreditation->unit->name,
                'file_path' => storage_path('/app/decree/sample.pdf'),
                'size' => Storage::size('decree/sample.pdf'),
                'type' => DecreeType::Accreditation,
                'decreeable_type' => $accreditation->decree()->getMorphClass(),
                'release_date' => now(),
                'validity_date' => Carbon::make(fake()->dateTimeBetween('now', '+4 years')),
            ]);

            AttachDecreeableToDecree::run($accreditation, $data);
        });
    }
}
