<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\PlanPrice;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\SubscriptionMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function model()
    {
        return new Subscription();
    }

    public function store(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $existingSubscription = Subscription::where('customer_id', $customer->id)
            ->where('status', '1')
            ->first();

        if (!$existingSubscription && !$request->has('plan_price_id')) {
            $basicPlanPrice = PlanPrice::whereHas('priceplans', function ($q) {
                $q->where('name', 'Basic');
            })->first();

            if (!$basicPlanPrice) {
                return back()->with('error', 'Basic plan not found.');
            }

            $request->merge(['plan_price_id' => $basicPlanPrice->id]);
        }

        $request->validate([
            'plan_price_id' => 'required|exists:plan_prices,id',
        ]);

        $planPrice = PlanPrice::with('priceplans')->findOrFail($request->plan_price_id);
        // dd($planPrice->priceplans);
        if ($existingSubscription) {
            $existingSubscription->update(['status' => '0']);
        }

        $start_date = now();
        $end_date = $start_date->copy()->addDays($planPrice->duration);

        $subscription = Subscription::create([
            'customer_id' => $customer->id,
            'plan_id' => $planPrice->plan_id,
            'plan' => $planPrice->priceplans->name ?? '',
            'duration' => $planPrice->duration,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'price' => $planPrice->price,
            'status' => '1',
        ]);

        Mail::to($customer->email)->send(new SubscriptionMail($subscription));
        return redirect()->route('home')->with('success', 'Subscription successful!');
    }



}
