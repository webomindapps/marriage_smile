<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store($id, Request $request)
    {
        $data = [
            'sender_id' => Auth::guard('customer')->user()->id,
            'receiver_id' => $id,
            'status' => 0
        ];
        $exists = $this->model()->where('sender_id', Auth::guard('customer')->user()->id)->where('receiver_id', $id)->first();
        if ($exists) {
            return redirect()->back()->with('success', 'Friend request already sent');
        }
        $this->model()->create($data);
        return redirect()->back()->with('success', 'Friend request sent successfully');
    }
    public function accept($id)
    {
        $this->model()->where('id', $id)->update(['status' => 1]);
        return redirect()->back()->with('success', 'Friend request accepted successfully');
    }
    public function reject($id)
    {
        $this->model()->where('id', $id)->update(['status' => 2]);
        return redirect()->back()->with('success', 'Friend request rejected successfully');
    }
}
