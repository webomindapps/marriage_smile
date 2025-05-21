<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.dashboard', compact( 'from_date', 'to_date'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
