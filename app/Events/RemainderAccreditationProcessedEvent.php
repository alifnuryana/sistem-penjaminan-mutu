<?php

namespace App\Events;

use App\Models\Accreditation;
use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RemainderAccreditationProcessedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Accreditation $accreditation;
    public Notification $notification;

    public function __construct(Accreditation $accreditation, Notification $notification)
    {
        $this->accreditation = $accreditation;
        $this->notification = $notification;
    }

    /**
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
