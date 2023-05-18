<?php

namespace Database\Seeders;

use App\Actions\Decree\AttachDecreeableToDecree;
use App\Actions\StudyPrograms\AddNewStudyProgram;
use App\Actions\Units\AttachUnitableToUnit;
use App\Actions\Universities\AddNewUniversity;
use App\Actions\Utilities\GenerateUniqueCode;
use App\Actions\Utilities\GetUnitsDummyData;
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
        //put file from database/documents to storage
        $files = collect([
            'sk_akreditasi.pdf', 'sk_pendirian.pdf'
        ]);
        $files->each(function ($file): void {
            $filePath = database_path('documents/' . $file);
            $content = file_get_contents($filePath);
            Storage::disk('local')->put($file, $content);
        });

        $units = GetUnitsDummyData::run();

        $units->each(function ($unit): void {
            if ('App\Models\University' === $unit['unitable_type']) {
                $university = AddNewUniversity::run(UniversityData::from([
                    'address' => $unit['address'],
                ]));

                AttachUnitableToUnit::run($university, UnitData::from([
                    'name' => $unit['name'],
                    'code' => $unit['code'],
                    'email' => $unit['email'],
                    'unitable_type' => $university->unit()->getMorphClass(),
                ]));

                AttachDecreeableToDecree::run($university, DecreeData::from([
                    'code' => GenerateUniqueCode::run('DOC', 10),
                    'name' => 'SK' . ' ' . $unit['name'],
                    'file_path' => 'sk_pendirian.pdf',
                    'size' => Storage::size('sk_akreditasi.pdf'),
                    'type' => DecreeType::Establishment,
                    'decreeable_type' => $university->decree()->getMorphClass(),
                    'release_date' => now(),
                ]));
            } else {
                $studyProgram = AddNewStudyProgram::run(StudyProgramData::from([
                    'degree' => $unit['degree'],
                    'university_id' => University::first()->id,
                ]));

                AttachUnitableToUnit::run($studyProgram, UnitData::from([
                    'name' => $unit['name'],
                    'code' => $unit['code'],
                    'email' => $unit['email'],
                    'unitable_type' => $studyProgram->unit()->getMorphClass(),
                ]));

                AttachDecreeableToDecree::run($studyProgram, DecreeData::from([
                    'code' => GenerateUniqueCode::run('DOC', 10),
                    'name' => 'SK' . ' ' . $unit['name'],
                    'file_path' => 'sk_pendirian.pdf',
                    'size' => Storage::size('sk_pendirian.pdf'),
                    'type' => DecreeType::Establishment,
                    'decreeable_type' => $studyProgram->decree()->getMorphClass(),
                    'release_date' => now(),
                ]));
            }
        });
    }
}
