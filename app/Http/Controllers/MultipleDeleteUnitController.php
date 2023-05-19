<?php

namespace App\Http\Controllers;

use App\Actions\Units\DeleteUnitById;
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

        foreach ($ids as $id) {
            DeleteUnitById::run($id);
        }

        return redirect(route('data.units.index'));
    }
}
