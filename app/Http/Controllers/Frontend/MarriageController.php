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
        $matches = collect(); // empty by default

        // Check if the user submitted the form with at least one search field
        if (
            $request->filled('age_from') ||
            $request->filled('age_to') ||
            $request->filled('religion') ||
            $request->filled('mother_tongue') ||
            $request->filled('gender')
        ) {
            $query = Customer::query();

            $query->whereHas('details', function ($q) use ($request) {
                if ($request->filled('age_from') && $request->filled('age_to')) {
                    $q->whereBetween('age', [$request->age_from, $request->age_to]);
                }

                if ($request->filled('religion')) {
                    $q->where('religion', $request->religion);
                }

                if ($request->filled('mother_tongue')) {
                    $q->where('mother_tongue', $request->mother_tongue);
                }

                if ($request->filled('gender')) {
                    $q->where('gender', $request->gender);
                }
            });

            $matches = $query->with('details')->get();
        }

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
