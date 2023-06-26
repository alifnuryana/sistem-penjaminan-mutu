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
        $fileContent = \File::get($samplePdfPath);
        Storage::disk('public')->put('decrees/sample.pdf', $fileContent);
    }
}
