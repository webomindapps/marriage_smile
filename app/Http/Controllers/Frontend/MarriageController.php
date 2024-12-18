<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Testimonials;
use Illuminate\Http\Request;

class MarriageController extends Controller
{
    public function index()
    {
        $testimonials = Testimonials::all();
        $faqs = FAQ::orderBy('position', 'asc')->where('status', true)->get();
        return view('frontend.pages.index', compact('testimonials', 'faqs'));
    }
}