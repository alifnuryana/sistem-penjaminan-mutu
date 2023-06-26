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
            ->line("Status akreditasi anda akan berakhir pada {$this->accreditation->decree->validity_date->locale('id')->format('d F Y')}.");
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
        /* This sets the $time variable to the current hour in the 24 hour clock format */
        $time = date("H");
        /* Set the $timezone variable to become the current timezone */
        $timezone = date("e");
        /* If the time is less than 1200 hours, show good morning */
        if ($time < "12") {
            return "Selamat Pagi";
        } else {
            /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
            if ($time >= "12" && $time < "17") {
                return "Selamat Sore";
            } else {
                /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                if ($time >= "17" && $time < "19") {
                    return "Selamat Malam";
                } else {
                    /* Finally, show good night if the time is greater than or equal to 1900 hours */
                    if ($time >= "19") {
                        return "Selamat Malam";
                    }
                }
            }
        }
    }
}
