<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class MultipleDeleteUnitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $ids = $request->input('ids');

        Unit::whereIn('id', $ids)->delete();

        return redirect(route('data.units.index'));
    }
}
