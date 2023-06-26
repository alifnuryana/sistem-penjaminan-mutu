<?php

namespace App\Http\Controllers;

use App\Actions\Accreditations\AddNewAccreditation;
use App\Actions\Accreditations\GetAllAccreditations;
use App\Actions\Accreditations\SearchAllAccreditations;
use App\Actions\Decree\AttachDecreeableToDecree;
use App\Actions\Units\GetUnitNotAccredited;
use App\Actions\Utilities\FilePondUpload;
use App\Actions\Utilities\GenerateUniqueCode;
use App\Data\AccreditationData;
use App\Data\DecreeData;
use App\Enums\AccreditationGrade;
use App\Enums\AccreditationStatus;
use App\Enums\DecreeType;
use App\Http\Requests\CreateAccreditationRequest;
use App\Http\Resources\AccreditationResource;
use App\Http\Resources\UnitResource;
use App\Jobs\ProcessAccreditationJob;
use App\Models\Accreditation;
use App\Models\Decree;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use RahulHaque\Filepond\Facades\Filepond;

class AccreditationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get Keyword Query Params
        $keyword = $request->input('keyword');

        // Get All Accreditation Sorted by Validity Date (Latest) + Paginated
        $accreditations = Accreditation::query()
            ->with(['decree', 'unit', 'unit.unitable'])
            ->where('status', '=', AccreditationStatus::Active)
            ->when($keyword, function (Builder $query) use ($keyword) {
                return $query->whereHas('unit', function (Builder $query) use ($keyword) {
                    return $query->where('name', 'ILIKE', '%' . $keyword . '%');
                });
            })
            ->orderBy(
                Decree::select('validity_date')
                    ->whereColumn('decreeable_id', '=', 'accreditations.id')
                    ->orderByDesc('validity_date')
                    ->limit(1)
            )
            ->paginate(10)
            ->withQueryString();

        // Get Unit Not Accredited Count
        $notAccreditedCount = Unit::query()
            ->with(['accreditations'])
            ->whereDoesntHave('accreditations', function (Builder $query) {
                return $query->where('status', '=', AccreditationStatus::Active);
            })
            ->count();

        // Render and Pass Data to View
        return Inertia::render('Accreditations/Index', compact('accreditations', 'notAccreditedCount', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Generate new code
        $newCode = $this->generateCode('AKRE');

        // Get unit where not accredited
        $units = Unit::query()
            ->with(['accreditations', 'unitable'])
            ->whereDoesntHave('accreditations', function (Builder $query) {
                return $query->where('status', '=', AccreditationStatus::Active);
            })
            ->get();

        // Render and pass data to view
        return Inertia::render('Accreditations/Create', compact('newCode', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAccreditationRequest $request)
    {
        // Upload Decree
        $decreeInfo = Filepond::field($request->decree)->moveTo('/decree/' . $request->get('decree_number'));

        // Create new accreditation
        $accreditation = Accreditation::query()
            ->create([
                'code' => $this->generateCode('AKRE'),
                'grade' => AccreditationGrade::tryFrom($request->get('grade')),
                'status' => AccreditationStatus::Active,
                'unit_id' => $request->get('unit_id'),
            ]);

        // Attach decree to accreditation
        foreach ($decreeInfo as $decree) {
            $accreditation->decree()->create([
                'code' => $this->generateCode('DOC'),
                'name' => $decree['filename'],
                'file_path' => $decree['location'],
                'size' => 2000,
                'type' => DecreeType::Accreditation,
                'decreeable_type' => $accreditation->decree()->getMorphClass(),
                'release_date' => Carbon::create($request->get('release_date')),
                'validity_date' => Carbon::create($request->get('due_date')),
            ]);
        }

        // Dispatch a job
        ProcessAccreditationJob::dispatch($accreditation);

        // Redirect to index of accreditations
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

    protected function generateCode(string $prefix)
    {
        return $prefix . '-' . date('Ymd') . '-' . mb_substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 5);
    }
}
