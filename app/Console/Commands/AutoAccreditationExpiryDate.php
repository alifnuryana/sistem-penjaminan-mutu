<?php

namespace App\Console\Commands;

use App\Mail\AccreditationExpiryDate;
use App\Models\Accreditation;
use App\Models\Decree;
use App\Models\Notification;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class AutoAccreditationExpiryDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-accreditation-expiry-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to unit when accreditation is about to expire.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notifications = Notification::query()
            ->where('due_date', today())
            ->get();

        if ($notifications->count() >= 1) {
            foreach ($notifications as $notification) {
                Mail::to($notification->accreditation->unit)
                    ->send(new AccreditationExpiryDate($notification->accreditation));
            }
        }
    }
}
