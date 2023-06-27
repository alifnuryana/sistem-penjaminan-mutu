<?php

namespace App\Enums;

enum NotificationStatus: string
{
    case Sended = 'Terkirim';
    case NotSended = 'Tidak Terkirim';
    case Scheduled = 'Belum Terkirim';
}
