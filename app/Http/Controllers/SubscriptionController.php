<?php

namespace App\Http\Controllers;

use App\Models\PlanPrice;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function model()
    {
        return new Subscription();
    }
    public  function store(Request $request)
    {
        // $request->validate([
        //     'plan_id' => 'required',
        // ]);
        $planPrice = PlanPrice::all();
        dd($planPrice);
        $customer = Auth::guard('customer')->user();
        $start_date = Carbon::now();
        $end_date = $start_date->copy()->addDays($planPrice->duration);
    }
}
