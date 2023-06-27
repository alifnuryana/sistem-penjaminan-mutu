<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class MultipleDeleteNotificationController extends Controller
{
    public function __invoke(Request $request)
    {
        $ids = $request->input('ids');

        foreach ($ids as $id) {
            Notification::query()
                ->where('id', '=', $id)
                ->delete();
        }

        return redirect(route('data.notifications.index'));
    }
}
