<?php

namespace App\Http\Controllers\Frontend;

use App\Models\FAQ;
use App\Models\Plan;
use App\Models\Feature;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarriageController extends Controller
{
    public function index()
    {
        $testimonials = Testimonials::all();
        $faqs = FAQ::orderBy('position', 'asc')->where('status', true)->get();
        return view('frontend.pages.index', compact('testimonials', 'faqs'));
    }
    public function pricingView()
    {
        $plans = Plan::where('status', true)->orderBy('position', 'asc')->with('features', 'prices')->get();
        $allFeatures = Feature::all();

        return view('frontend.pages.pricing', compact('plans', 'allFeatures'));
    }
}
