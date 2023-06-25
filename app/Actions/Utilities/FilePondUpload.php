<?php

namespace App\Actions\Utilities;

use Lorisleiva\Actions\Concerns\AsAction;
use RahulHaque\Filepond\Facades\Filepond;

class FilePondUpload
{
    use AsAction;

    public function handle($file, string $pathInStorage, string $fileName): ?array
    {
        return Filepond::field($file)->moveTo($pathInStorage . $fileName);
    }
}
