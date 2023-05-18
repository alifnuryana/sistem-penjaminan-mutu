<?php

namespace App\Observers;

use App\Actions\Decree\DeleteDecreeByMorphId;
use App\Models\Accreditation;

class AccreditationObserver
{
    /**
     * Handle the Accreditation "created" event.
     */
    public function created(Accreditation $accreditation): void
    {
    }

    /**
     * Handle the Accreditation "updated" event.
     */
    public function updated(Accreditation $accreditation): void
    {
        //
    }

    /**
     * Handle the Accreditation "deleted" event.
     */
    public function deleted(Accreditation $accreditation): void
    {
        DeleteDecreeByMorphId::run($accreditation->id);
    }

    /**
     * Handle the Accreditation "restored" event.
     */
    public function restored(Accreditation $accreditation): void
    {
        //
    }

    /**
     * Handle the Accreditation "force deleted" event.
     */
    public function forceDeleted(Accreditation $accreditation): void
    {
        //
    }
}
