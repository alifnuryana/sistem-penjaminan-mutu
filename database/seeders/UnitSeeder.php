<?php

namespace Database\Seeders;

use App\Enums\DecreeType;
use App\Models\StudyProgram;
use App\Models\University;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        //put file from database/documents to storage
        $files = collect([
            'sk_akreditasi.pdf', 'sk_pendirian.pdf'
        ]);
        $files->each(function ($file) : void {
           $filePath = database_path('documents/' . $file);
           $content = file_get_contents($filePath);
           Storage::disk('local')->put($file, $content);
        });
        $units = collect([
            [
                'name' => 'Universitas Widyatama',
                'code' => $this->generateUniqueCode('UNIV', 10),
                'email' => 'utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\University',
                'address' => 'Jl. Cikutra No.204 A, Cikutra, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40124',
            ],
            [
                'name' => 'Teknik Informatika',
                'code' => $this->generateUniqueCode('PROD', 10),
                'email' => 'if.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Sistem Informasi',
                'code' => $this->generateUniqueCode('PROD', 10),
                'email' => 'si.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Manajemen',
                'code' => $this->generateUniqueCode('PROD', 10),
                'email' => 'manajemen.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Akutansi',
                'code' => $this->generateUniqueCode('PROD', 10),
                'email' => 'akutansi.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Perdagangan Internasional',
                'code' => $this->generateUniqueCode('PROD', 10),
                'email' => 'pedagen.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Teknik Industri',
                'code' => $this->generateUniqueCode('PROD', 10),
                'email' => 'industri.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Teknik Elektro',
                'code' => $this->generateUniqueCode('PROD', 10),
                'email' => 'teknik.elektro.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Teknik Sipil',
                'code' => $this->generateUniqueCode('PROD', 10),
                'email' => 'sipil.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Teknik Mesin',
                'code' => $this->generateUniqueCode('PROD', 10),
                'email' => 'mesin.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Perpustakaan & Sains Informasi',
                'code' => $this->generateUniqueCode('PROD', 10),
                'email' => 'perpustakaan.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
        ]);

        $units->each(function ($unit) : void {
            if ('App\Models\University' === $unit['unitable_type']) {
                $unitable = University::create([
                    'address' => $unit['address'],
                ]);

                $unitable->unit()->create([
                    'name' => $unit['name'],
                    'code' => $unit['code'],
                    'email' => $unit['email'],
                    'unitable_type' => $unitable->unit()->getMorphClass(),
                ]);
                $file = Storage::get('surat.pdf');
                $unitable->decree()->create([
                    'code' => $this->generateUniqueCode('Decree', 10),
                    'decreeable_type' => $unitable->decree()->getMorphClass(),
                    'name' => 'SK' . $unit['name'],
                    'file_path' => 'surat.pdf',
                    'type' => DecreeType::establishment,
                    'size' => Storage::size('surat.pdf'),
                    'validity_date' => null,
                ]);

            } else {
                $unitable = StudyProgram::create([
                    'degree' => $unit['degree'],
                    'university_id' => University::first()->id,
                ]);

                $unitable->unit()->create([
                    'name' => $unit['name'],
                    'code' => $unit['code'],
                    'email' => $unit['email'],
                    'unitable_type' => $unitable->unit()->getMorphClass(),
                ]);

                $file = Storage::get('surat.pdf');
                $unitable->decree()->create([
                    'code' => $this->generateUniqueCode('Decree', 10),
                    'decreeable_type' => $unitable->decree()->getMorphClass(),
                    'name' => 'SK' . " " . $unit['name'],
                    'file_path' => 'surat.pdf',
                    'type' => array_rand(['SK Pendirian', 'SK Akreditasi']) == 0 ? DecreeType::establishment : DecreeType::accreditation,
                    'size' =>  Storage::size('surat.pdf'),
                    'validity_date' => date('Y-m-d',strtotime(fake()->date() . ' + 5 years'))
                ]);
            }
        });
    }

    public function generateUniqueCode(string $prefix, int $length = 10) : string
    {
        $code = $prefix;
        $code .= mb_strtoupper(mb_substr(md5(uniqid((string) rand(), TRUE)), 0, $length - mb_strlen($prefix)));

        return $code;
    }
}
