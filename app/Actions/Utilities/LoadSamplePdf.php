<?php

namespace App\Actions\Utilities;

use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class LoadSamplePdf
{
    use AsAction;

    /**
     * Load sample pdf file to storage.
     */
    public function handle(): void
    {
        $samplePdfPath = database_path('seeders/files/sample.pdf');
        Storage::put('/decree/sample.pdf', file_get_contents($samplePdfPath));
    }
}
