<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GotMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public array $message)
    {
        //
    }

    public function broadcastOn(): PrivateChannel
    {
        // Only the intended receiver will get the message
        return new PrivateChannel('chat.' . $this->message['receiver_id']);
    }

    // Optional: control the payload sent to the frontend
    public function broadcastWith(): array
    {
        return $this->message;
    }
}
