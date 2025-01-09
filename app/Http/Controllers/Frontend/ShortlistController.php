<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Shortlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShortlistController extends Controller
{
    public function addToShortlist(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();
        $exist = Shortlist::where('customer_id', $customer->id)->where('profile_id', $id)->first();
        if ($exist) {
            $exist->delete();
            return back()->with('message', 'Profile removed successfully');
        } else {
            $shortlist = Shortlist::create([
                'customer_id' => $customer->id,
                'profile_id' => $id,
            ]);
            return back()->with('message', 'Profile added successfully');
        }
    }
    public function shortlist()
    {
        $customer = Auth::guard('customer')->user();
        $shortlist = Shortlist::with(['customer', 'customer.documents'])->where('customer_id', $customer->id)->get();
        return view('frontend.customer.shortlist', compact('shortlist'));
    }
    public function removeFromShortlist($id)
    {
        Shortlist::destroy($id);
        return back()->with('message', 'Profile removed from Shortlist  successfully');
    }
}
