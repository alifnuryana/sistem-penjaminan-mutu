<?php

namespace App\Http\Controllers;

use App\Actions\Accreditations\DeleteAccreditation;
use App\Enums\AccreditationStatus;
use App\Enums\NotificationStatus;
use App\Models\Accreditation;
use App\Models\Notification;
use Illuminate\Http\Request;

class MultipleDeleteAccreditationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $ids = $request->input('ids');

        foreach ($ids as $id) {
            Accreditation::query()
                ->where('id', '=', $id)
                ->update([
                    'status' => AccreditationStatus::Inactive,
                ]);

            Notification::query()
                ->where([
                    ['accreditation_id', '=', $id],
                    ['status', '=', NotificationStatus::Scheduled]
                ])
                ->delete();
        }

        return redirect(route('accreditations.index'));
    }
}
