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
     * @param string $pathInStorage
     * @param UploadedFile $file
     * @param string $fileName
     * @return void
     */
    public function handle(string $pathInStorage, UploadedFile $file, string $fileName): void
    {
        Storage::putFileAs($pathInStorage, $file, $fileName);
    }
}
