<?php

namespace Database\Seeders;

use App\Actions\Decree\AttachDecreeableToDecree;
use App\Actions\Notifications\CreateNewNotification;
use App\Actions\Utilities\GenerateMailNumber;
use App\Actions\Utilities\GenerateUniqueCode;
use App\Data\DecreeData;
use App\Enums\AccreditationStatus;
use App\Enums\DecreeType;
use App\Enums\NotificationStatus;
use App\Models\Accreditation;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class AccreditationSeeder extends Seeder
{
    public function run(): void
    {
        Unit::all()->each(function (Unit $unit): void {
            $accreditation = Accreditation::factory()->create([
                'status' => AccreditationStatus::Active,
                'unit_id' => $unit->id,
            ]);

            $data = DecreeData::from([
                'code' => GenerateUniqueCode::run('DOC', 10),
                'name' => GenerateMailNumber::run(),
                'file_path' => 'sample.pdf',
                'size' => Storage::size('decree/sample.pdf'),
                'type' => DecreeType::Accreditation,
                'decreeable_type' => $accreditation->decree()->getMorphClass(),
                'release_date' => Carbon::make(fake()->dateTimeBetween('-4 years', '-1 years')),
                'validity_date' => Carbon::make(fake()->dateTimeBetween('now', '+4 years')),
            ]);

            AttachDecreeableToDecree::run($accreditation, $data);

            CreateNewNotification::run($accreditation, 10);
        });
    }
}
