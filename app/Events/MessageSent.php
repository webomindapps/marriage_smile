<?php

namespace App\Events;

use App\Models\ChatMessage;
use App\Models\Customer;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customer, $chatMessage;

    /**
     * Create a new event instance.
     */
    public function __construct(Customer $customer, ChatMessage $chatMessage)
    {
        $this->customer = $customer;
        $this->chatMessage = $chatMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("marriage-chat"),
        ];
    }

    public function broadcastWith()
    {
        return ['message' => $this->chatMessage];
    }
}
