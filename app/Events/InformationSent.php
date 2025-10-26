<?php

namespace App\Events;

use App\Models\Information;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InformationSent implements ShouldBroadcast
{
    use SerializesModels;

    public $information;
    public $recipientIds;

    public function __construct(Information $information, $recipientIds)
    {
        $this->information = $information;
        $this->recipientIds = $recipientIds;
    }

    public function broadcastOn()
    {
        return collect($this->recipientIds)->map(function ($id) {
            return new PrivateChannel('user.' . $id);
        })->toArray();
    }

    public function broadcastAs()
    {
        return 'information.received';
    }
}
