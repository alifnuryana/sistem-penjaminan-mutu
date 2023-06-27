<?php

namespace App\Http\Controllers;

use App\Enums\AccreditationStatus;
use App\Jobs\ProcessRemainderAccreditationJob;
use App\Models\Accreditation;
use App\Models\Notification;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SendUnitRemainderController extends Controller
{
    public function __invoke(Unit $unit, Notification $notification, Request $request)
    {
        $accreditation = Accreditation::query()
            ->where([
                ['unit_id', '=', $unit->id],
                ['status', '=', AccreditationStatus::Active],
            ])
            ->first();

        ProcessRemainderAccreditationJob::dispatchSync($accreditation, $notification);

        return redirect(route('data.units.show', $unit->code));
    }
}
