<?php

namespace App\Http\Controllers;

use App\Actions\Accreditations\AddNewAccreditation;
use App\Actions\Accreditations\GetAllAccreditations;
use App\Actions\Accreditations\SearchAllAccreditations;
use App\Actions\Units\GetUnitNotAccredited;
use App\Actions\Utilities\GenerateUniqueCode;
use App\Data\AccreditationData;
use App\Enums\AccreditationGrade;
use App\Enums\AccreditationStatus;
use App\Http\Requests\CreateAccreditationRequest;
use App\Http\Resources\AccreditationResource;
use App\Http\Resources\UnitResource;
use App\Models\Accreditation;
use App\Services\UtilityService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AccreditationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $accreditations = $request->input('keyword')
            ? SearchAllAccreditations::run($request->input('keyword'), true)
            : GetAllAccreditations::run(true);

        return Inertia::render('Accreditations/Index', [
            'accreditations' => AccreditationResource::collection($accreditations),
            'unitNotAccreditedCount' => GetUnitNotAccredited::run()->count(),
            'keyword' => $request->input('keyword'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(UtilityService $utilityService)
    {
        return Inertia::render('Accreditations/Create', [
            'code' => GenerateUniqueCode::run('AKRE'),
            'units' => UnitResource::collection(GetUnitNotAccredited::run()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAccreditationRequest $request)
    {
        $file = $request->file('decree');
        $name = $file->hashName();

        // TODO : simpan juga file ke dalam database decree
        $upload = Storage::put('decree', $file);

        $data = AccreditationData::from([
            'code' => GenerateUniqueCode::run('AKRE'),
            'grade' => AccreditationGrade::tryFrom($request->input('grade')),
            'status' => AccreditationStatus::Active,
            'due_date' => Carbon::create($request->input('due_date')),
            'unit_id' => $request->input('unit_id'),
        ]);

        AddNewAccreditation::run($data);

        return redirect(route('accreditations.index'));
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
