<?php

namespace App\Http\Controllers;

use App\Models\Accreditation;
use Illuminate\Http\Request;

class MultipleDeleteAccreditationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $ids = $request->input('ids');

        Accreditation::whereIn('id', $ids)->delete();

        return redirect(route('accreditations.index'));
    }
}
