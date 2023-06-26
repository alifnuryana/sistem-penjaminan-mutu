<?php

namespace App\Http\Controllers;

use App\Actions\Decree\AttachDecreeableToDecree;
use App\Actions\StudyPrograms\AddNewStudyProgram;
use App\Actions\Units\AttachUnitableToUnit;
use App\Actions\Units\GetAllUnits;
use App\Actions\Units\SearchAllUnit;
use App\Actions\Utilities\FilePondUpload;
use App\Actions\Utilities\GenerateUniqueCode;
use App\Data\DecreeData;
use App\Data\StudyProgramData;
use App\Data\UnitData;
use App\Enums\DecreeType;
use App\Enums\NotificationStatus;
use App\Http\Requests\CreateUnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\Accreditation;
use App\Models\Decree;
use App\Models\Notification;
use App\Models\StudyProgram;
use App\Models\Unit;
use App\Models\University;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DataUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $units = $request->input('keyword')
            ? SearchAllUnit::run(true, $request->input('keyword'))
            : GetAllUnits::run(true);

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
        $decreeInfo = FilePondUpload::run($request->decree, '/decrees/', $request->get('decree_number'));

        $studyProgram = AddNewStudyProgram::run(StudyProgramData::from([
            'degree' => $request->get('degree'),
            'university_id' => University::first()->id,
        ]));

        // Attach StudyProgram to Unit
        AttachUnitableToUnit::run($studyProgram, UnitData::from([
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'email' => $request->get('email'),
            'unitable_type' => 'App\Models\StudyProgram',
        ]));

        // Attach StudyProgram to Decree
        foreach ($decreeInfo as $decree) {
            AttachDecreeableToDecree::run($studyProgram, DecreeData::from([
                'code' => GenerateUniqueCode::run('SK'),
                'name' => $decree['filename'],
                'type' => DecreeType::Establishment,
                'size' => 2000,
                'release_date' => Carbon::parse($request->get('release_date')),
                'file_path' => $decree['basename'],
                'decreeable_type' => StudyProgram::class,
            ]));
        }
        return redirect()->route('data.units.index')->with('success', 'Unit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        $unit->load(['unitable', 'accreditations']);

        $accreditations = Accreditation::query()
            ->with(['notifications', 'decree'])
            ->where('unit_id', '=', $unit->id)
            ->first();

        $notifications = null;
        if ($accreditations !== null) {
            $notifications = Notification::query()
                ->with(['accreditation'])
                ->where('accreditation_id', '=', $accreditations->id)
                ->orderBy('due_date')
                ->get();
        }


        return Inertia::render('Data/Unit/Show', compact('unit', 'notifications'));
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
