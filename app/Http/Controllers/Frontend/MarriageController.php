<?php

namespace App\Http\Controllers\Frontend;

use App\Models\FAQ;
use App\Models\Plan;
use App\Models\Feature;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class MarriageController extends Controller
{
    public function index(Request $request)
    {

        $query = Customer::query();

        $query->whereHas('details', function ($q) use ($request) {
            $q->whereBetween('age', [$request->age_from, $request->age_to])
                ->where('religion', $request->religion)
                ->where('mother_tongue', $request->mother_tongue)
                ->where('gender', $request->gender);
        });

        $matches = $query->with('details')->get();

        $testimonials = Testimonials::all();
        $faqs = FAQ::orderBy('position', 'asc')->where('status', true)->get();
        return view('frontend.pages.index', compact('testimonials', 'faqs', 'matches'), [
            'isLoggedIn' => Auth::check(),


        ]);
    }
    public function pricingView()
    {
        $plans = Plan::where('status', true)->orderBy('position', 'asc')->with('features', 'prices')->get();
        $allFeatures = Feature::all();

        return view('frontend.pages.pricing', compact('plans', 'allFeatures'));
    }
}
