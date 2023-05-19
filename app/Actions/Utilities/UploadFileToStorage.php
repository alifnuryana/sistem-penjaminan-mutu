<?php

namespace App\Actions\Utilities;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class UploadFileToStorage
{
    use AsAction;

    /**
     * Upload file to storage.
     */
    public function handle(string $pathInStorage, UploadedFile $file, string $fileName): void
    {
        Storage::putFileAs($pathInStorage, $file, $fileName);
    }
}
