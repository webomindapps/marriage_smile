<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionValidation;

class FriendRequestController extends Controller
{
    public function model()
    {
        return new FriendRequest();
    }
    public function index()
    {
        $requests = $this->model()->where('receiver_id', Auth::guard('customer')->user()->id)->where('status', 0)->get();
        return view('frontend.customer.friend-requests', compact('requests'));
    }
    // public function store($id, Request $request)
    // {
    //     $data = [
    //         'sender_id' => Auth::guard('customer')->user()->id,
    //         'receiver_id' => $id,
    //         'status' => 0
    //     ];
    //     $exists = $this->model()->where('sender_id', Auth::guard('customer')->user()->id)->where('receiver_id', $id)->first();
    //     if ($exists) {
    //         return redirect()->back()->with('success', 'Friend request already sent');
    //     }
    //     $this->model()->create($data);
    //     return redirect()->back()->with('success', 'Friend request sent successfully');
    // }
    // public function accept($id)
    // {
    //     $this->model()->where('id', $id)->update(['status' => 1]);
    //     return redirect()->back()->with('success', 'Friend request accepted successfully');
    // }

    public function store($id, Request $request)
    {
        $senderId = Auth::guard('customer')->user()->id;

        $subscription = SubscriptionValidation::where('customer_id', $senderId)->first();
        if (!$subscription) {
            return redirect()->back()->with('error', 'Subscription not found.');
        }

        if ($subscription->chat_viewable !== 'Unlimited' && (!is_numeric($subscription->chat_viewable) || $subscription->chat_viewable <= 0)) {
            return redirect()->route('pricing')->with('error', 'Upgrade your plan to send requests.');
        }

        $exists = $this->model()->where('sender_id', $senderId)->where('receiver_id', $id)->first();
        if ($exists) {
            return redirect()->back()->with('success', 'Friend request already sent');
        }

        // Deduct one from sender’s chat_viewable if not Unlimited
        if (is_numeric($subscription->chat_viewable) && $subscription->chat_viewable > 0) {
            $subscription->chat_viewable = (int) $subscription->chat_viewable - 1;
            $subscription->save();
        }

        $this->model()->create([
            'sender_id' => $senderId,
            'receiver_id' => $id,
            'status' => 0
        ]);

        return redirect()->back()->with('success', 'Friend request sent successfully');
    }


    public function accept($id)
    {
        $friendRequest = FriendRequest::find($id);

        if (!$friendRequest) {
            return redirect()->back()->with('error', 'Friend request not found.');
        }

        $receiverId = $friendRequest->receiver_id;
        $receiverSubscription = SubscriptionValidation::where('customer_id', $receiverId)->first();

        if (!$receiverSubscription) {
            return redirect()->back()->with('error', 'Subscription details missing.');
        }

        $receiverCanChat = false;
        if ($receiverSubscription->chat_viewable >0) {
            $receiverCanChat = true;
        } elseif (is_numeric($receiverSubscription->chat_viewable) && (int) $receiverSubscription->chat_viewable > 0) {
            $receiverCanChat = true;
        }

        if ($receiverCanChat) {
            if (is_numeric($receiverSubscription->chat_viewable) && (int) $receiverSubscription->chat_viewable > 0) {
                $receiverSubscription->chat_viewable = (int) $receiverSubscription->chat_viewable - 1;
                $receiverSubscription->save();
            }

            $friendRequest->update(['status' => 1]);

            return redirect()->back()->with('success', 'Friend request accepted successfully.');
        }

        return redirect()->back()->with('error', 'Chat limit reached. Cannot accept the friend request,Please Subscribe.');
    }





    public function reject($id)
    {
        $this->model()->where('id', $id)->update(['status' => 2]);
        return redirect()->back()->with('success', 'Friend request rejected successfully');
    }
}
