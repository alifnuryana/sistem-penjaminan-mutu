<?php

namespace App\Http\Controllers;

use App\Actions\Accreditations\DeleteAccreditation;
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
            DeleteAccreditation::run($id);
        }

        return redirect(route('accreditations.index'));
    }
}
