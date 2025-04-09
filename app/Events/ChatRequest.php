<?php

namespace App\Events;

use App\Models\Customer;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatRequest implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender, $receiver, $type;

    /**
     * Create a new event instance.
     */
    public function __construct(Customer $sender, Customer $receiver, $type)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->type = $type;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat-request.' . $this->receiver->id);
    }

    public function broadcastWith()
    {
        return [
            'sender_id' => $this->sender->id,
            'type' => $this->type,
            'sender_name' => $this->sender->first_name . ' ' . $this->sender->last_name,
            'message' => 'You have a new chat request from ' . $this->sender->first_name,
        ];
    }
}
