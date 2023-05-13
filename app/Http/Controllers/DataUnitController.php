<?php

namespace App\Http\Controllers;

use App\Http\Resources\UnitResource;
use App\Models\Unit;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function destroys(Request $request)
    {
        dd('Hitted');

        return redirect()->back();
    }
}
