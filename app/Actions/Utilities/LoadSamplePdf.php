<?php

namespace App\Actions\Utilities;

use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class LoadSamplePdf
{
    use AsAction;

    /**
     * Load sample pdf file to storage.
     * @return void
     */
    public function handle(): void
    {
        $samplePdfPath = database_path('seeders/files/sample.pdf');
        Storage::put('sample.pdf', file_get_contents($samplePdfPath));
    }
}
