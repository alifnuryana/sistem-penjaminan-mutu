<?php

namespace App\Actions\Utilities;

use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUnitsDummyData
{
    use AsAction;

    /**
     * Get dummy data for units.
     */
    public function handle(): Collection
    {
        return collect([
            [
                'name' => 'Universitas Widyatama',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\University',
                'address' => 'Jl. Cikutra No.204 A, Cikutra, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40124',
            ],
            [
                'name' => 'Teknik Informatika',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'if.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Sistem Informasi',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'si.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Manajemen',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'manajemen.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Akutansi',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'akutansi.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Perdagangan Internasional',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'pedagen.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Teknik Industri',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'industri.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Teknik Elektro',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'teknik.elektro.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Teknik Sipil',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'sipil.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Teknik Mesin',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'mesin.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
            [
                'name' => 'Perpustakaan & Sains Informasi',
                'code' => GenerateUniqueCode::run('UNIV', 10),
                'email' => 'perpustakaan.utama@widyatama.ac.id',
                'unitable_type' => 'App\Models\StudyProgram',
                'degree' => 'S1',
            ],
        ]);
    }
}
