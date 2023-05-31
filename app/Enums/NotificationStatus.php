<?php

namespace App\Enums;

enum NotificationStatus: string
{
    case Sent = 'sent';
    case Failed = 'failed';
    case Pending = 'pending';
}
