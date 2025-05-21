<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Shortlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProfileViewable;
use App\Models\Subscription;
use App\Models\SubscriptionValidation;
use Illuminate\Support\Facades\Auth;

class ShortlistController extends Controller
{
    public function addToShortlist(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();
        $exist = Shortlist::where('customer_id', $customer->id)->where('profile_id', $id)->first();
        if ($exist) {
            $exist->delete();
            return back()->with('success', 'Profile removed successfully');
        } else {
            $shortlist = Shortlist::create([
                'customer_id' => $customer->id,
                'profile_id' => $id,
            ]);
            return back()->with('success', 'Profile added successfully');
        }
    }
    public function shortlist()
    {
        $customer = Auth::guard('customer')->user();
        $shortlist = Shortlist::with(['customer', 'customer.documents', 'customer.details'])->where('customer_id', $customer->id)->get();
        $subscription = SubscriptionValidation::where('customer_id', $customer->id)->first();
        $viewedProfileIds = ProfileViewable::where('customer_id', Auth::guard('customer')->id())
            ->pluck('profile_id')
            ->toArray();
        $duration = Subscription::where('customer_id', $customer->id)
            ->where('status', 1)
            ->latest()
            ->first();
        $shortlistedIds = Shortlist::where('customer_id', Auth::guard('customer')->id())
            ->pluck('profile_id') // adjust field name if different
            ->toArray();
        return view('frontend.customer.shortlist', compact('shortlist', 'subscription', 'viewedProfileIds', 'duration', 'shortlistedIds'));
    }
    public function removeFromShortlist($id)
    {
        Shortlist::destroy($id);
        return back()->with('message', 'Profile removed from Shortlist  successfully');
    }
}
