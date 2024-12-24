<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Carbon\Carbon;
use App\Models\Customer;
use App\Mail\PreferredDay;
use App\Mail\RelationManger;
use Illuminate\Http\Request;
use App\Mail\CustomerRegister;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CustomerDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    public function register()
    {
        return view('frontend.auth.register');
    }

    public function storecustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'nationality' => 'required|string',
            'religion' => 'required|string',
            'gender' => 'required|string',
            'qualification' => 'required|string',
            'dob' => 'required|date',
            'mother_tongue' => 'required|string',
            'caste' => 'required|string',
            'gotra' => 'required|string',
            'sun_star' => 'required|string',
            'birth_star' => 'required|string',
            'annual_income' => 'required',
            'company_name' => 'required|string',
            'experience' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|same:conf_password',
            'conf_password' => 'required',
            'aadhar_no' => 'required|digits:12',
            'hobbies' => 'required|string',
            'facebook_profile' => 'nullable|url',
            'marritialstatus' => 'required|string',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'father_occupation' => 'required|string',
            'mother_occupation' => 'required|string',
            'siblings' => 'required|string',
            'locations' => 'required|string',
            'permanent_locations' => 'required|string',
            'present_house_status' => 'required|string',
            'permanent_house_status' => 'required|string',
            'asset_value' => 'required|string',
            'preferreday' => 'required|string',
            'preferred_contact_no' => 'required|numeric',
            'contact_related_to' => 'required|string',
            'image_path' => 'nullable|image',
            'image_url' => 'nullable|array',
            'image_url.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        DB::beginTransaction();

        try {
            $customerData = $request->only([
                'name',
                'email',
                'phone',
                'password',
                'conf_password',
                'email_verified_at'
            ]);

            $customerData['password'] = Hash::make($customerData['password']);

            $latestCustomer = Customer::latest()->first();
            $customerData['customer_id'] = $latestCustomer ? 'MS' . str_pad((int) substr($latestCustomer->customer_id, 2) + 1, 3, '0', STR_PAD_LEFT) : 'MS001';

            $customer = Customer::create($customerData);


            if ($request->hasFile('image_url')) {
                $imageUrls = $request->file('image_url');
                foreach ($imageUrls as $imageUrl) {
                    $path = $imageUrl->store('documents/profiles', 'public');

                    $customer->documents()->create([
                        'customers_id' => $customer->id,
                        'image_url' => $path,
                    ]);
                }
            }

            $customerDetailsData = $request->only([
                'customers_id',
                'nationality',
                'religion',
                'gender',
                'height',
                'colour',
                'qualification',
                'dob',
                'age',
                'mother_tongue',
                'caste',
                'annual_income',
                'company_name',
                'experience',
                'req_rel_manager',
                'expectations',
                'gotra',
                'sun_star',
                'birth_star',
                'aadhar_no',
                'image_path',
                'hobbies',
                'marritialstatus',
                'father_name',
                'mother_name',
                'father_occupation',
                'mother_occupation',
                'siblings',
                'locations',
                'present_house_status',
                'permanent_locations',
                'permanent_house_status',
                'asset_value',
                'preferreday',
                'timings',
                'preferred_contact_no',
                'contact_related_to',
            ]);
            $req_rel_manager = $request->input('req_rel_manager');
            $timings = $request->input('timings');

            $customerDetailsData['customers_id'] = $customer->id;

            $customer->details()->create($customerDetailsData);
            if ($request->hasFile('image_path')) {
                $path = $request->file('image_path')->store('documents/horoscope', 'public');
                $customer->details()->update(['image_path' => $path]);
            }
            $i = 1;
            while ($request->has("child_{$i}_gender")) {
                $childData = [
                    'customers_id' => $customer->id,
                    'child_gender' => $request->input("child_{$i}_gender"),
                    'child_age' => $request->input("child_{$i}_age"),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('customer_relations')->insert($childData);
                $i++;
            }

            $i = 1;
            while ($request->has("sibling_{$i}_marital_status")) {
                $siblingData = [
                    'customers_id' => $customer->id,
                    'sibling_maritial_status' => $request->input("sibling_{$i}_marital_status"),
                    'sibling_age_relation' => $request->input("sibling_{$i}_age_relation"),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('customer_relations')->insert($siblingData);
                $i++;
            }

            DB::commit();
            if ($req_rel_manager === 'Yes') {
                Mail::to('sunil@webomindapps.com')->send(new RelationManger($customer));
            }
            if ($timings) {
                Mail::to('sunil@webomindapps.com')->send(new PreferredDay($customer));
            }
            Mail::to($request->email)->send(new CustomerRegister($customer));

            return redirect()->route('customer.login')->with('verify', 'Customer registered successfully');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return back()->with('error', 'An error occurred while registering the customer: ' . $e->getMessage());
        }
    }





    public function edit($id)
    {
        $customer = Customer::find($id);
        // dd($customer);
        // if (!$customer) {
        //     return redirect()->route('admin.customer.index')->with('error', 'Customer not found.');
        // }

        return view('frontend.customer.update', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        $validatedData = $request->validate([
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
            'email' => 'required|email',
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
        DB::beginTransaction();

        try {
            $customer->update($validatedData);

            if ($request->hasFile('image_path')) {
                $path = $request->file('image_path')->store('documents/horoscope', 'public');
                $customer->update(['image_path' => $path]);
            }

            DB::commit();

            return redirect()->route('customer.profile')->with('verify', 'Customer Data Updated successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with('error', 'An error occurred while updating the customer: ' . $e->getMessage());
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

        if (is_null($cust->email_verified_at)) {
            return back()->with('danger', 'Verify your account first');
        }

        $attempt = Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password]);

        if ($attempt) {
            $customer = Auth::guard('customer')->user();
            return redirect()->route('customer.matches');
        } else {
            $attempt = Auth::guard('customer')->attempt(['customer_id' => $request->email, 'password' => $request->password]);
            if ($attempt) {
                $customer = Auth::guard('customer')->user();
                return redirect()->route('customer.matches');
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
        $customer = Auth::guard('customer')->user();
        return view('frontend.customer.profile', compact('customer'));
    }
    public function matches()
    {
        $customer = Auth::guard('customer')->user();

        $oppositeGender = $customer->details->gender === 'male' ? 'female' : 'male';

        $profiledetails = CustomerDetails::with(['customer.documents'])->where('gender', $oppositeGender)->get();


        return view('frontend.customer.matches', compact('profiledetails'));
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }

    public function detail()
    {
        return view('frontend.customer.profile-detail');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $customer = Customer::where('email', $user->email)->first();

            if ($customer) {
                $customer->update(['email_verified_at' => Carbon::now()]);
                Auth::guard('customer')->login($customer);



                $intendedUrl = Session::get('url.intended');
                $profile = route('customer.matches');
                return redirect()->intended($intendedUrl ?? $profile);
            } else {
                Customer::create([
                    'name' => $user->user['given_name'],
                    'lastname' => $user->user['family_name'],
                    'email' => $user->email,
                    'email_verified_at' => Carbon::now()
                ]);
                $customer = Customer::where('email', $user->email)->first();
                Auth::guard('customer')->login($customer);
                return redirect()->route('customer.matches');
            }
        } catch (Exception $e) {
            // dd($e);
            return redirect('auth/google');
        }
    }
    public function getCustomerById(Request $request)
    {
        $customerId = $request->customer_id;
        $customer = Customer::with('details')->where('customer_id', $customerId)->first();

        if ($customer) {
            return response()->json(['success' => true, 'data' => $customer]);
        }

        return response()->json(['success' => false, 'message' => 'Customer not found']);
    }
    public function searchOppositeGender(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $oppositeGender = $customer->details->gender === 'male' ? 'female' : 'male';

        $age = $request->input('age');
        $maritalStatus = $request->input('marital_status');

        $query = Customer::whereHas('details', function ($query) use ($oppositeGender, $age, $maritalStatus) {
            $query->where('gender', $oppositeGender);

            if ($age && $age !== "Doesn't Matter") {
                [$ageStart, $ageEnd] = explode('-', $age);
                $query->whereBetween('age', [(int)$ageStart, (int)$ageEnd]);
            }

            if ($maritalStatus && $maritalStatus !== "Doesn't Matter") {
                $query->where('marital_status', $maritalStatus);
            }
        })
            ->with('details') 
            ->get();

        return response()->json($query);
    }
    public function searchById($id)
    {
        $profile = Customer::with('details')->find($id);

        if (!$profile) {
            return response()->json(['message' => 'Profile not found.'], 404);
        }

        return response()->json($profile);
    }
}
