<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\Customer;
use App\Models\CustomerPasswordResets;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomerPasswordResetController extends Controller
{
    public function forgetMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers',
        ]);
        $email = $request->email;
        $token = Str::random(64);
        CustomerPasswordResets::create([
            'email' => $email,
            'token' => $token,
        ]);
        $customer = Customer::where('email', $email)->first();
        Mail::to($email)->send(new ForgotPasswordMail($customer, $token));
        return back()->with('message', 'Password reset mail sent to your email address');
    }

    public function resetView($token)
    {
        return view('frontend.auth.reset-password', compact('token'));
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:customers',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ], [
            'confirm_password.same' => 'Password and confirm password should be same',
            'confirm_password.required' => 'Confirm password field is required',
        ]);
        $token = CustomerPasswordResets::where('token', $request->reset_token)->first();

        if (is_null($token)) {
            return back()->with('error', 'Token mismatch');
        } else {
            $customer = Customer::where('email', $request->email)->first();
            $customer->update([
                'password' => Hash::make($request->password)
            ]);
        }
        return redirect()->route('customer.login')->with('message', 'Password reseted successfully');
    }
}
