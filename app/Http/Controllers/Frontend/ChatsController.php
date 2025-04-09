<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ChatRequest;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\ChatPermission;
use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function index(Customer $user)
    {
        $messages = ChatMessage::with(['sender', 'receiver'])
            ->whereIn('sender_id', [Auth::guard('customer')->id(), $user->id])
            ->whereIn('receiver_id', [Auth::guard('customer')->id(), $user->id])
            ->get();
        return response()->json($messages);
    }

    public function store(Customer $user, Request $request)
    {
        // $se_permission = ChatPermission::where('sender_id', Auth::guard('customer')->id())->where('receiver_id', $user->id)->first();
        // if ($se_permission) {
        //     if ($se_permission->is_blocked) {
        //         return response("error");
        //     }
        // } else {
        //     return response("error");
        // }
        $message = ChatMessage::create([
            'sender_id' => Auth::guard('customer')->id(),
            'receiver_id' => $user->id,
            'text' => $request->message,
        ]);
        broadcast(new MessageSent($user, $message))->toOthers();
        return response()->json($message);
    }

    public function chat($id)
    {
        $customer = Customer::find($id);
        $sender = Auth::guard('customer')->user();
        // $sender_per = ChatPermission::where('sender_id', $sender->id)->where('receiver_id', $customer->id)->first();
        // $receiver_per = ChatPermission::where('receiver_id', $sender->id)->where('sender_id', $customer->id)->first();
        // if (is_null($sender_per) && $sender->id != $customer->id) {
        //     $sender_per = ChatPermission::create([
        //         'sender_id' => $sender->id,
        //         'receiver_id' => $customer->id,
        //     ]);
        //     Notification::create([
        //         'sender_id' => $sender->id,
        //         'receiver_id' => $customer->id,
        //         'type' => "request",
        //         'message' => "You have a new chat request from " . $sender->first_name,
        //     ]);
        //     event(new ChatRequest($sender, $customer, "request"));
        // }
        // if (is_null($receiver_per) && $sender->id != $customer->id) {
        //     $receiver_per = ChatPermission::create([
        //         'sender_id' => $customer->id,
        //         'receiver_id' => $sender->id,
        //         'is_approved' => true
        //     ]);
        // }
        return view('frontend.customer.chat', compact('customer', 'sender',));
    }
    public function conversations()
    {
        $customerId = Auth::guard('customer')->id();

        $conversations = Customer::whereIn('id', function ($query) use ($customerId) {
            $query->select('receiver_id')
                ->from('chat_messages')
                ->where('sender_id', $customerId)
                ->union(function ($query) use ($customerId) {
                    $query->select('sender_id')
                        ->from('chat_messages')
                        ->where('receiver_id', $customerId);
                });
        })->get();
        return response()->json($conversations);
    }
    public function approve($id)
    {
        $permission = ChatPermission::find($id);
        $permission->update(['is_approved' => true]);
        Notification::create([
            'sender_id' => $permission->receiver->id,
            'receiver_id' => $permission->sender->id,
            'type' => "approv",
            'message' => $permission->receiver?->first_name . " has accepted your chat request",
        ]);
        event(new ChatRequest($permission->receiver, $permission->sender, "approv"));
        return back();
    }
    public function block($id)
    {
        $permission = ChatPermission::find($id);
        if ($permission->is_blocked) {
            $permission->update(['is_blocked' => false]);
        } else {
            $permission->update(['is_blocked' => true]);
        }
        return back();
    }
}
