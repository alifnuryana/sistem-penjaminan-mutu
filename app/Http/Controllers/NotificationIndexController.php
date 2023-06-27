<?php

namespace App\Http\Controllers;

use App\Enums\NotificationStatus;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationIndexController extends Controller
{
    public function __invoke(Request $request)
    {
        // get keyword for search
        $keyword = $request->get('keyword');
        $filter = $request->get('filter');

        // get all notifications
        $notifications = Notification::query()
            ->with(['accreditation', 'accreditation.unit'])
            ->when($filter, function (Builder $query) use ($filter) {
                return $query->whereIn('status', $filter);
            })
            ->when($keyword, function (Builder $query) use ($keyword) {
                return $query->whereHas('accreditation', function (Builder $query) use ($keyword) {
                    return $query->whereHas('unit', function (Builder $query) use ($keyword) {
                        return $query->where('name', 'ILIKE', "%{$keyword}%");
                    });
                });
            })
            ->orderBy('due_date')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Data/Notification/Index', compact('keyword', 'notifications', 'filter'));
    }
}
