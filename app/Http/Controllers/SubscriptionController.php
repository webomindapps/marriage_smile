<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\PlanPrice;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\SubscriptionMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\SubscriptionValidation;

class SubscriptionController extends Controller
{
    public function model()
    {
        return new Subscription();
    }

    public function store(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $request->validate([
            'plan_price_id' => 'required|exists:plan_prices,id',
        ]);

        $planPrice = PlanPrice::with('priceplans')->findOrFail($request->plan_price_id);

        // Deactivate any existing active subscription
        Subscription::where('customer_id', $customer->id)
            ->where('status', '1')
            ->update(['status' => '0']);

        $start_date = now();
        $end_date = $start_date->copy()->addDays($planPrice->duration);

        // Create or update subscription
        $subscription = Subscription::updateOrCreate(
            [
                'customer_id' => $customer->id,
                'plan_id' => $planPrice->plan_id,
            ],
            [
                'plan' => $planPrice->priceplans->name ?? '',
                'duration' => $planPrice->duration,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'price' => $planPrice->special_price,
                'status' => '1',
            ]
        );

        // Fetch plan features
        $plan = Plan::with('features')->find($planPrice->plan_id);
        foreach ($plan->features as $plans) {
            if ($plans->name == 'Photo Access' || $plans->name == 'Horoscope Access' || $plans->name == 'Profiles' || $plans->name == 'Chats With Bride or Groom')
                $planid = $plans->id;
        }

        $featureMap = [
            $planid => 'photo_viewable',
            $planid  => 'hscop_viewable',
            $planid  => 'chat_viewable',
            $planid  => 'profile_viewable',
        ];

        $featureValues = [
            'photo_viewable' => 0,
            'hscop_viewable' => 0,
            'profile_viewable' => 0,
            'chat_viewable' => null,
        ];

        foreach ($plan->features as $feature) {
            if (array_key_exists($feature->id, $featureMap)) {
                $column = $featureMap[$feature->id];
                $featureValues[$column] = $feature->pivot->feature_value;
            }
        }

        // Create or update subscription validation
        SubscriptionValidation::updateOrCreate(
            ['customer_id' => $customer->id],
            [
                'plan_id' => $plan->id,
                'subscription_id' => $subscription->id,
                'photo_viewable' => $featureValues['photo_viewable'],
                'hscop_viewable' => $featureValues['hscop_viewable'],
                'profile_viewable' => $featureValues['profile_viewable'],
                'chat_viewable' => $featureValues['chat_viewable'],
            ]
        );

        // Mail::to($customer->email)->send(new SubscriptionMail($subscription));

        return redirect()->route('home')->with('success', 'Subscription successful!');
    }
}
