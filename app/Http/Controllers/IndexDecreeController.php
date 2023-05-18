<?php

namespace App\Http\Controllers;

use App\Actions\GetAllDecree;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexDecreeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Data/Decree/Index', [
            'decrees' => GetAllDecree::run(),
        ]);
    }
}
