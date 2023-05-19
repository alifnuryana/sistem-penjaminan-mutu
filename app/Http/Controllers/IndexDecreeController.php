<?php

namespace App\Http\Controllers;

use App\Actions\Decree\GetAllDecree;
use App\Actions\Decree\SearchAllDecree;
use App\Http\Resources\DecreeResource;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexDecreeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $decrees = $request->input('keyword')
            ? SearchAllDecree::run($request->input('keyword'), true)
            : GetAllDecree::run(true);

        return Inertia::render('Data/Decree/Index', [
            'decrees' => DecreeResource::collection($decrees),
            'keyword' => $request->input('keyword'),
        ]);
    }
}
