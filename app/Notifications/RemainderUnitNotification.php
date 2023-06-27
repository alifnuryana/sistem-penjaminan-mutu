<?php

namespace App\Notifications;

use App\Models\Accreditation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RemainderUnitNotification extends Notification
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
            ->subject('Pemberitahuan Masa Berlaku Akreditasi')
            ->greeting($this->getGreeting())
            ->line("Status akreditasi {$this->accreditation->unit->name} akan berakhir pada {$this->accreditation->decree->validity_date->locale('id')->format('d F Y')}.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    protected function getGreeting()
    {
        $time = date("H");
        $timezone = date("e");
        if ($time < "12") {
            return "Selamat Pagi";
        } else {
            if ($time >= "12" && $time < "17") {
                return "Selamat Sore";
            } else {
                if ($time >= "17" && $time < "19") {
                    return "Selamat Malam";
                } else {
                    if ($time >= "19") {
                        return "Selamat Malam";
                    }
                }
            }
        }
    }
}
