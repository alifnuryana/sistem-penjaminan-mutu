<?php

namespace App\Notifications;

use App\Models\Accreditation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAccreditationNotification extends Notification
{
    use Queueable;

    public Accreditation $accreditation;

    public function __construct(Accreditation $accreditation)
    {
        $this->accreditation = $accreditation;
    }

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pemberitahuan Status Akreditasi')
            ->greeting('Selamat Pagi')
            ->line("Status akreditasi {$this->accreditation->unit->name} telah aktif.")
            ->line("Akreditasi berakhir pada {$this->accreditation->decree->validity_date->locale('id')->format('d F Y')}.");
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
