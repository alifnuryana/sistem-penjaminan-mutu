<?php

namespace App\Http\Controllers;

use App\Enums\AccreditationStatus;
use App\Http\Resources\AccreditationResource;
use App\Http\Resources\UnitResource;
use App\Models\Accreditation;
use App\Models\Unit;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccreditationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $accreditations = Accreditation::query()
            ->with([
                'unit.unitable',
            ])
            ->when($request->input('keyword'), function ($query, $keyword) {
                $keyword = ucwords($keyword);
                return $query->whereHas('unit', function ($query) use ($keyword) {
                    return $query
                        ->where('code', 'like', "%{$keyword}%")
                        ->orWhere('name', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('due_date')
            ->paginate(10)
            ->withQueryString();

        $statusAccreditation = Unit::query()
            ->with(['accreditations', 'unitable'])
            ->whereDoesntHave('accreditations', function ($query) : void {
                $query->where('status', '=', AccreditationStatus::Active);
            })
            ->get();

        return Inertia::render('Accreditations/Index', [
            'accreditations' => AccreditationResource::collection($accreditations),
            'unitNotAccreditedCount' => $statusAccreditation->count(),
            'keyword' => $request->input('keyword'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(UtilityService $utilityService)
    {
        $units = Unit::query()
            ->with(['accreditations', 'unitable'])
            ->whereDoesntHave('accreditations', function ($query) : void {
                $query->where('status', '=', AccreditationStatus::Active);
            })
            ->get();

        return Inertia::render('Accreditations/Create', [
            'code' => $utilityService->generateNewCode('AKRE'),
            'units' => UnitResource::collection($units),
        ]);
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
    public function show(Accreditation $accreditation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accreditation $accreditation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accreditation $accreditation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accreditation $accreditation)
    {
        //
    }
}
