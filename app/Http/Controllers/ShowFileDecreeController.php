<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ShowFileDecreeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $path)
    {
        return \response()->file(
            Storage::path('decree/' . $path)
        );
    }
}
