<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShowFileDecreeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        /* TODO : ini masih error coba fix */
        return Storage::response($request->input('path'));
    }
}
