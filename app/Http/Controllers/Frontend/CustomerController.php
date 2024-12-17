<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\CustomerRegister;
use App\Models\Customer;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function register()
    {
        return view('frontend.auth.register');
    }

    public function storecustomer(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name' => 'required|string',
                'nationality' => 'required|string',
                'religion' => 'required|string',
                'qualification' => 'required|string',
                'dob' => 'required|date',
                'mother_tongue' => 'required|string',
                'caste' => 'required|string',
                'sub_caste' => 'required|string',
                'gotra' => 'required|string',
                'sun_star' => 'required|string',
                'birth_star' => 'required|string',
                'annual-income' => 'required|numeric',
                'company_name' => 'required|string',
                'experience' => 'required|string',
                'phone' => 'required|numeric',
                'email' => 'required|email|unique:customers,email',
                'password' => 'required|string|confirmed',
                'aadhar_no' => 'required|numeric|digits:12',
                'hobbies' => 'required|array', 
                'facebook_profile' => 'nullable|url',
                'marritialstatus' => 'required|string',
                'no_of_children' => 'nullable|integer',
                'father_name' => 'required|string',
                'mother_name' => 'required|string',
                'father_occupation' => 'required|string',
                'mother_occupation' => 'required|string',
                'siblings' => 'required|string',
                'locations' => 'required|string',
                'permanent_locations' => 'required|string',
                'house_status' => 'required|string',
                'asset_value' => 'required|string',
                'preferreday' => 'required|string',
                'timings' => 'nullable|string',
                'preferred_contact_no' => 'required|numeric',
                'contact_related_to' => 'required|string',
            ]);

            $data = $request->except(['profile_image_url', 'hobbies']);
            $data['password'] = Hash::make($data['password']);

            $data['hobbies'] = implode(',', $request->input('hobbies'));

            $latestCustomer = Customer::latest()->first();
            if ($latestCustomer) {
                $lastId = (int) substr($latestCustomer->customer_id, 2);
                $data['customer_id'] = 'MS' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $data['customer_id'] = 'MS001';
            }

            $customer = Customer::create($data);

            if ($request->hasFile('image_path')) {
                $path = $request->file('image_path')->store('documents/horoscope', 'public');
            
                $customer->update(['image_path' => $path]);
            }
            
            

            DB::commit();

            Mail::to($request->email)->send(new CustomerRegister($customer));

            return redirect()->route('customer.login')->with('verify', 'Customer registered successfully');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('error', 'An error occurred while registering the customer: ' . $e->getMessage());
        }
    }


    public function login()
    {
        return view('frontend.auth.login');
    }
    public function verify()
    {
        return view('frontend.auth.email-verify');
    }
    public function sendVerifyMail()
    {
        $customer = auth('customer')->user();
        Mail::to($customer->email)->send(new CustomerRegister($customer));
        return back()->with('message', 'Verification mail sent successfully');
    }
    public function verifyEmail(Request $request)
    {
        $customer = Customer::where('email', $request->email)->first();
        $customer->email_verified_at = Carbon::now();
        $customer->save();
        return redirect()->route('customer.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([

            'password' => 'required'
        ]);

        $cust = Customer::where('email', $request->email)
            ->orWhere('customer_id', $request->email)
            ->first();

        if (is_null($cust) || $cust->password == '') {
            return back()->with('danger', 'Account Not Found');
        }


        $attempt = Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password]);

        if ($attempt) {
            $customer = Auth::guard('customer')->user();


            return redirect()->route('customer.profile');
        } else {
            $attempt = Auth::guard('customer')->attempt(['customer_id' => $request->email, 'password' => $request->password]);
            if ($attempt) {
                $customer = Auth::guard('customer')->user();


                return redirect()->route('customer.profile');
            }
        }

        return back()->with('danger', 'Invalid credentials.');
    }
    public function forget()
    {
        return view('frontend.auth.forgot-password');
    }
    public function profile()
    {
        $customer = Customer::all();
        return view('frontend.customer.profile', compact('customer'));
    }
}
