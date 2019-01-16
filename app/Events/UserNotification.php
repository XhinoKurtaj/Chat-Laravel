<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $conversationId;
    public $fullName;
    public $status;

    /**
     * Create a new event instance.
     *
     * @param $conversationId
     * @param $username
     */
    public function __construct($conversationId, $fullName, $status)
    {
        $this->conversationId = $conversationId;
        $this->fullName = $fullName;
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('conversation.'.$this->conversationId);
    }
}
