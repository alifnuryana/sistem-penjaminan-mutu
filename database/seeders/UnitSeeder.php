<?php

namespace Database\Seeders;

use App\Actions\Decree\AttachDecreeableToDecree;
use App\Actions\StudyPrograms\AddNewStudyProgram;
use App\Actions\Units\AttachUnitableToUnit;
use App\Actions\Universities\AddNewUniversity;
use App\Actions\Utilities\GenerateUniqueCode;
use App\Actions\Utilities\GetUnitsDummyData;
use App\Actions\Utilities\LoadSamplePdf;
use App\Data\DecreeData;
use App\Data\StudyProgramData;
use App\Data\UnitData;
use App\Data\UniversityData;
use App\Enums\DecreeType;
use App\Models\University;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoadSamplePdf::run();

        $units = GetUnitsDummyData::run();

        $units->each(function ($unit): void {
            $unitable = null;
            if ('App\Models\University' === $unit['unitable_type']) {
                $unitable = AddNewUniversity::run(UniversityData::from([
                    'address' => $unit['address'],
                ]));
            } else {
                $unitable = AddNewStudyProgram::run(StudyProgramData::from([
                    'degree' => $unit['degree'],
                    'university_id' => University::first()->id,
                ]));
            }

            AttachDecreeableToDecree::run($unitable, DecreeData::from([
                'code' => GenerateUniqueCode::run('DOC', 10),
                'name' => 'SK' . ' ' . $unit['name'],
                'file_path' => storage_path('/app/decree/sample.pdf'),
                'size' => Storage::size('decree/sample.pdf'),
                'type' => DecreeType::Establishment,
                'decreeable_type' => $unitable->decree()->getMorphClass(),
                'release_date' => now(),
            ]));

            AttachUnitableToUnit::run($unitable, UnitData::from([
                'name' => $unit['name'],
                'code' => $unit['code'],
                'email' => $unit['email'],
                'unitable_type' => $unitable->unit()->getMorphClass(),
            ]));
        });
    }
}
