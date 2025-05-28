<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\FAQ;
use App\Models\Feature;
use App\Models\Page;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return to_route('admin.dashboard')->with('success', 'You have successfully logged in.');
        }
        return back()->with('error', 'We did not find any admin with these credentials.');
    }

    public function dashboard(Request $request)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        // Initialize query filters
        $dateFilter = [];
        if ($from_date && $to_date) {
            $dateFilter = ['from' => $from_date, 'to' => $to_date];
        }

        $stats = [
            'plans' => [
                'total' => Plan::count(),
                'filtered' => $dateFilter ? Plan::whereBetween('created_at', [$from_date, $to_date])->count() : null,
            ],
            'features' => [
                'total' => Feature::count(),
                'filtered' => $dateFilter ? Feature::whereBetween('created_at', [$from_date, $to_date])->count() : null,
            ],
            'customers' => [
                'total' => Customer::count(),
                'filtered' => $dateFilter ? Customer::whereBetween('created_at', [$from_date, $to_date])->count() : null,
            ],
            'pages' => [
                'total' => Page::count(),
                'filtered' => $dateFilter ? Page::whereBetween('created_at', [$from_date, $to_date])->count() : null,
            ],
            'testimonials' => [
                'total' => Testimonials::count(),
                'filtered' => $dateFilter ? Testimonials::whereBetween('created_at', [$from_date, $to_date])->count() : null,
            ],
            'faqs' => [
                'total' => FAQ::count(),
                'filtered' => $dateFilter ? Faq::whereBetween('created_at', [$from_date, $to_date])->count() : null,
            ],
            'subscriptions' => [
                'total' => Subscription::count(),
                'filtered' => $dateFilter ? Subscription::whereBetween('created_at', [$from_date, $to_date])->count() : null,
            ],
         
        ];

        return view('admin.dashboard', compact('from_date', 'to_date', 'stats'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
