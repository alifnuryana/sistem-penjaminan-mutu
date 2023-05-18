<?php

namespace App\Http\Controllers;

use App\Actions\GetAllDecree;
use App\Models\Decree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DecreeController extends Controller
{
    public function index(){


        return Inertia::render('Data/Decree/index', [
            'decrees' => GetAllDecree::run()
        ]);
    }

    public function detail(){
        return 'success';
    }

    public function showFile($path){

        return response()->file(Storage::path($path));
    }
}
