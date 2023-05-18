<?php

namespace App\Http\Controllers;

use App\Models\Decree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DecreeController extends Controller
{
    public function index(){

        $decrees = Decree::all()->map(function ($decree){
            return[
                'name' => $decree->name,
                'code' => $decree->code,
                'type' => $decree->type,
                'url' => Storage::url($decree->file_path),
                'path' => $decree->file_path,
                'validity_date' => $decree->validity_date,
                'current_date' => (new \DateTime())->format('Y-m-d')
            ];
        })->sortByDesc('validity_date')->values()->all();
//        dd($decrees);
//        $file = Decree::first()->file_path;
//        return \Storage::url($file);
        return Inertia::render('Data/Decree/index', [
            'decrees' => $decrees
        ]);
    }

    public function detail(){
        return 'success';
    }

    public function showFile($path){

        return response()->file(Storage::path($path));
    }
}
