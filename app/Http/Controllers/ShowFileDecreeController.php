<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShowFileDecreeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($path)
    {
        $storagePath = Storage::path($path);
//        return response()->file($storagePath);

        $content =  Storage::disk('local')->get($path);
        $http_response_header =[
            'Content-Type' => 'application/pdf'
        ];
        return response($content, 200, $http_response_header);
    }
}
