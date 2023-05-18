<?php

namespace App\Http\Controllers;

use App\Actions\Utilities\GenerateUniqueCode;
use App\Http\Requests\CreateUnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\StudyProgram;
use App\Models\Unit;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DataUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $units = Unit::query()
            ->when($request->input('keyword'), function ($query, $keyword) {
                $keyword = ucwords($keyword);
                return $query->where('name', 'like', "%{$keyword}%");
            })
            ->with([
                'unitable',
            ])->paginate(10)
            ->withQueryString();

        return Inertia::render('Data/Unit/Index', [
            'units' => UnitResource::collection($units),
            'keyword' => $request->input('keyword'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Data/Unit/Create', [
            'code' => GenerateUniqueCode::run('UNIT'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUnitRequest $request)
    {
        $file = $request->file('decree');
        $name = $file->hashName();

        // TODO : simpan juga file ke dalam database decree
        $upload = Storage::put('decree', $file);

        $studyProgram = StudyProgram::query()->create([
            'degree' => $request->get('degree'),
            'university_id' => University::first()->id,
        ]);

        $studyProgram->unit()->create($request->only('code', 'name', 'email'));

        return redirect()->route('data.units.index')->with('success', 'Unit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $units)
    {
    }
}
