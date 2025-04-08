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

    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'plan_price_id' => 'required|exists:plan_prices,id',
    //     ]);

    //     $planPrice = PlanPrice::with('priceplans')->findOrFail($request->plan_price_id);
    //     // dd($planPrice->duration);
    //     $customer = Auth::guard('customer')->user();
    //     $start_date = now();
    //     $end_date = $start_date->copy()->addDays($planPrice->duration);

    //     Subscription::create([
    //         'customer_id' => $customer->id,
    //         'plan_id' => $planPrice->plan_id,
    //         'plan' => $planPrice->priceplans->name ?? '',
    //         'duration' => $planPrice->duration,
    //         'start_date' => $start_date,
    //         'end_date' => $end_date,
    //         'price' => $planPrice->price,
    //         // 'payment_type' => 'online',
    //         // 'payment_id' => '1',
    //         'status' => '1',
    //     ]);

    //     return redirect()->route('home')->with('success', 'Subscription successful!');
    // }
    public function store(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // Check if the customer already has an active subscription
        $existingSubscription = Subscription::where('customer_id', $customer->id)
            ->where('status', '1')
            ->first();

        // If customer is new (no subscription) and plan_price_id not submitted, assign Basic
        if (!$existingSubscription && !$request->has('plan_price_id')) {
            $basicPlanPrice = PlanPrice::whereHas('priceplans', function ($q) {
                $q->where('name', 'Basic');
            })->first();

            if (!$basicPlanPrice) {
                return back()->with('error', 'Basic plan not found.');
            }

            $request->merge(['plan_price_id' => $basicPlanPrice->id]);
        }

        // Validate and fetch the chosen PlanPrice
        $request->validate([
            'plan_price_id' => 'required|exists:plan_prices,id',
        ]);

        $planPrice = PlanPrice::with('priceplans')->findOrFail($request->plan_price_id);

        // Deactivate any previous subscription if exists
        if ($existingSubscription) {
            $existingSubscription->update(['status' => '0']);
        }

        // Set subscription duration
        $start_date = now();
        $end_date = $start_date->copy()->addDays($planPrice->duration);

        // Create new subscription
        Subscription::create([
            'customer_id' => $customer->id,
            'plan_id' => $planPrice->plan_id,
            'plan' => $planPrice->priceplans->name ?? '',
            'duration' => $planPrice->duration,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'price' => $planPrice->price,
            'status' => '1',
        ]);

        return redirect()->route('home')->with('success', 'Subscription successful!');
    }



}
