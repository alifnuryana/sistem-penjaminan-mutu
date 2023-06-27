<?php

namespace App\Http\Controllers;

use App\Enums\AccreditationStatus;
use App\Enums\NotificationStatus;
use App\Models\Accreditation;
use App\Models\Notification;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $totalAccreditation = Accreditation::query()
            ->count();
        $totalAccreditationActive = Accreditation::query()
            ->where('status', '=', AccreditationStatus::Active)
            ->count();
        $totalAccreditationInactive = Accreditation::query()
            ->where('status', '=', AccreditationStatus::Inactive)
            ->count();

        $totalUnit = Unit::query()
            ->count();
        $totalUnitHasActiveAccreditation = Unit::query()
            ->with(['accreditations'])
            ->whereDoesntHave('accreditations', function (Builder $query) {
                return $query->where('status', '!=', AccreditationStatus::Active);
            })
            ->count();

        $totalUnitDoesntHaveActiveAccreditation = Unit::query()
            ->with(['accreditations'])
            ->whereDoesntHave('accreditations', function (Builder $query) {
                return $query->where('status', '=', AccreditationStatus::Active);
            })
            ->count();

        $totalNotification = Notification::query()
            ->count();

        $totalScheduleNotification = Notification::query()
            ->where('status', '=', NotificationStatus::Scheduled)
            ->count();

        $totalSendedNotification = Notification::query()
            ->where('status', '=', NotificationStatus::Sended)
            ->count();

        return Inertia::render('Dashboard', compact('totalAccreditation', 'totalAccreditationActive', 'totalAccreditationInactive', 'totalUnit', 'totalUnitHasActiveAccreditation', 'totalUnitDoesntHaveActiveAccreditation', 'totalNotification', 'totalScheduleNotification', 'totalSendedNotification'));
    }
}
