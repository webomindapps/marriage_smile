<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Carbon\Carbon;
use App\Models\Plan;
use App\Models\Customer;
use App\Models\PlanPrice;
use App\Mail\PreferredDay;
use App\Mail\RelationManger;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\CustomerRegister;
use App\Mail\SubscriptionMail;
use App\Models\CustomerDetails;
use App\Models\ProfileViewable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\SubscriptionValidation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

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
            'expectations' => 'nullable',
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
                'email_verified_at'
            ]);
            $customerData['status'] = 1;
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
                'dob',
                'age',
                'caste',
                'annual_income',
                'company_name',
                'designation',
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
            if ($request->qualification == 'Others') {
                $customerDetailsData['qualification'] = $request->otherqualification;
            } else {
                $customerDetailsData['qualification'] = $request->qualification;
            }
            if ($request->mother_tongue == 'Others') {
                $customerDetailsData['mother_tongue'] = $request->othermother_tongue;
            } else {
                $customerDetailsData['mother_tongue'] = $request->mother_tongue;
            }
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

            $basicPlan = PlanPrice::whereHas('priceplans', function ($q) {
                $q->where('name', 'Basic');
            })->first();

            if ($basicPlan && $basicPlan->priceplans) {
                $start_date = now();
                $end_date = $start_date->copy()->addDays($basicPlan->duration);

                $subscription = Subscription::create([
                    'customer_id' => $customer->id,
                    'plan_id' => $basicPlan->plan_id,
                    'plan_price_id' => $basicPlan->id,
                    'plan' => $basicPlan->priceplans->name ?? 'Basic',
                    'duration' => $basicPlan->duration,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'price' => $basicPlan->price,
                    'status' => '1',
                ]);
            }
            $plan = Plan::with('features')->find($basicPlan->plan_id);
            $featureMap = [
                1 => 'photo_viewable',
                4 => 'hscop_viewable',
                5 => 'chat_viewable',
                6 => 'profile_viewable',
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
            SubscriptionValidation::create([
                'customer_id' => $customer->id,
                'plan_id' => $plan->id,
                'subscription_id' => $subscription->id,
                'photo_viewable' => $featureValues['photo_viewable'],
                'hscop_viewable' => $featureValues['hscop_viewable'],
                'profile_viewable' => $featureValues['profile_viewable'],
                'chat_viewable' => $featureValues['chat_viewable'],
            ]);
            // dd($subscription);
            Mail::to($customer->email)->send(new SubscriptionMail($subscription));

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
        return view('frontend.customer.update', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'image_path' => 'nullable|image',
            'image_url.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        DB::beginTransaction();

        try {
            // Update customer basic details
            $customerData = $request->only(['name', 'email', 'phone']);
            $customer->update($customerData);

            // Update documents
            if ($request->hasFile('image_url')) {
                foreach ($request->file('image_url') as $imageUrl) {
                    $path = $imageUrl->store('documents/profiles', 'public');
                    $customer->documents()->create([
                        'customers_id' => $customer->id,
                        'image_url' => $path,
                    ]);
                }
            }

            // Update customer details
            $customerDetailsData = $request->only([
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
                'designation',
                'experience',
                'req_rel_manager',
                'expectations',
                'gotra',
                'sun_star',
                'birth_star',
                'aadhar_no',
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

            $customerDetails = CustomerDetails::where('customers_id', $customer->id)->first();
            // dd($customerDetails);
            if (!$customerDetails) {
                // If no record exists, you can create one or handle it as an error
                return back()->with('error', 'Customer details not found. Please ensure they exist before updating.');
            }

            $customerDetails->update($customerDetailsData);
            // Update image_path in customer details
            if ($request->hasFile('image_path')) {
                $path = $request->file('image_path')->store('documents/horoscope', 'public');
                CustomerDetails::where('customers_id', $customer->id)->update(['image_path' => $path]);
            }

            // Update customer relations (children and siblings)
            DB::table('customer_relations')->where('customers_id', $customer->id)->delete();

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

            return redirect()->route('customer.profile', $id)->with('success', 'Customer updated successfully');
        } catch (\Exception $e) {
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

        // Check if the user exists and has a valid password
        if (!$cust || !$cust->password || !Hash::check($request->password, $cust->password)) {
            return back()->with('danger', 'Invalid credentials.');
        }

        // Check email verification before login
        if (!$cust->email_verified_at) {
            return back()->with('danger', 'Verify your account first.');
        }

        // Determine whether to use email or customer_id
        $credentials = ['password' => $request->password];
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->email;
        } else {
            $credentials['customer_id'] = $request->email;
        }

        if (Auth::guard('customer')->attempt($credentials)) {
            $customer = Auth::guard('customer')->user();
            $customer->last_login_time = now();
            $customer->save();
            return redirect()->route('customer.matches');
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
    // public function matches(Request $request)
    // {
    //     $profileId = $request->customer_id;
    //     $customer = Auth::guard('customer')->user();
    //     $oppositeGender = $customer->details->gender === 'male' ? 'female' : 'male';


    //     $query = CustomerDetails::with(['customer.documents'])
    //         ->where('gender', $oppositeGender);


    //     if (!empty($profileId)) {
    //         $query->whereHas('customer', function ($q) use ($profileId) {
    //             $q->where('customer_id', $profileId);
    //         });
    //     }


    //     if ($request->filled('age_from') || $request->filled('age_to')) {
    //         $ageFrom = (int) ($request->age_from ?? 18); // Default minimum age
    //         $ageTo = (int) ($request->age_to ?? 100);    // Default maximum age
    //         $query->whereBetween('age', [$ageFrom, $ageTo]);
    //     }


    //     if ($request->filled('marital_status') && $request->marital_status !== "Doesn't Matter") {
    //         $query->where('marritialstatus', $request->marital_status);
    //     }

    //     // Execute the query
    //     $profiledetails = $query->paginate(10);

    //     return view('frontend.customer.matches', compact('profiledetails'));
    // }

    public function matches(Request $request)
    {
        $profileId = $request->customer_id;
        $profilename = $request->name;
        $customer = Auth::guard('customer')->user();
        $oppositeGender = $customer->details->gender === 'male' ? 'female' : 'male';

        $query = CustomerDetails::with(['customer.documents'])
            ->where('gender', $oppositeGender);

        if (!empty($profileId)) {
            $query->whereHas('customer', function ($q) use ($profileId) {
                $q->where('customer_id', $profileId);
            });
        }

        if (!empty($profilename)) {
            $query->whereHas('customer', function ($q) use ($profilename) {
                $q->where('name', $profilename);
            });
        }

        if ($request->filled('age_from') || $request->filled('age_to')) {
            $ageFrom = (int) ($request->age_from ?? 18);
            $ageTo = (int) ($request->age_to ?? 100);
            $query->whereBetween('age', [$ageFrom, $ageTo]);
        }

        if ($request->filled('marital_status') && $request->marital_status !== "Doesn't Matter") {
            $query->where('marritialstatus', $request->marital_status);
        }

        $profiledetails = $query->paginate(10);
        // dd($profiledetails);
        foreach ($profiledetails as $profile) {
            $matchedCustomer = Auth::guard('customer')->user();
            // dd($matchedCustomer);
            $subscription = Subscription::where('customer_id', $matchedCustomer->id)
                ->where('status', 1)
                ->latest()
                ->first();
            // dd($subscription);
            $photoLimit = 0;

        }
        $subscription = SubscriptionValidation::where('customer_id', $customer->id)->first();
        $viewedProfileIds = ProfileViewable::where('customer_id', Auth::guard('customer')->id())
            ->pluck('profile_id')
            ->toArray();

        return view('frontend.customer.matches', compact('profiledetails', 'subscription', 'viewedProfileIds'));
    }
    public function detail($id)
    {
        $customer = Auth::guard('customer')->user(); // logged-in customer
        $profileId = $id;
        // dd($profileId);
        $alreadyViewed = ProfileViewable::where('customer_id', $customer->id)
            ->where('profile_id', $profileId)
            ->exists();
        // dd($alreadyViewed);
        if (!$alreadyViewed) {
            $subscription = SubscriptionValidation::where('customer_id', $customer->id)->first();
            // if (!$subscription || $subscription->profile_viewable <= 0) {
            //     return redirect()->route('pricing');
            // }

            ProfileViewable::create([
                'customer_id' => $customer->id,
                'plan_id' => $subscription->plan_id,
                'subscription_id' => $subscription->subscription_id,
                'profile_id' => $profileId,
            ]);

            $subscription->decrement('profile_viewable');
            // dd($subscription);
        }

        $pendingViews = SubscriptionValidation::where('customer_id', $customer->id)->value('profile_viewable');

        $customer = CustomerDetails::with('customer')->findOrFail($profileId);
        // dd($customer);
        return view('frontend.customer.profile-detail', compact('customer', 'pendingViews'));
    }
    //     public function downloadHoroscope($id)
//     {
//         $customer = Auth::guard('customer')->user();
// // dd($customer);
//         $subscription = SubscriptionValidation::where('customer_id', $customer->id)->first();

    //         if (!$subscription || $subscription->hscop_viewable <= 0) {
//             return redirect()->back()->with('error', 'Horoscope download limit reached.');
//         }

    //         // Get file path
//         $customerDetail = CustomerDetails::with('customer')->findOrFail($id);
//         $filePath = $customerDetail->image_path;

    //         if (!Storage::disk('public')->exists($filePath)) {
//             return redirect()->back()->with('error', 'File not found.');
//         }

    //         // Decrease count
//         $subscription->decrement('hscop_viewable');

    //         // Download the file
//         return response()->download(storage_path('app/public/' . $filePath));
//     }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }

    // public function detail($id)
    // {
    //     $customer = CustomerDetails::with('customer')->find($id);
    //     return view('frontend.customer.profile-detail', compact('customer'));
    // }
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
                $query->whereBetween('age', [(int) $ageStart, (int) $ageEnd]);
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
    public function deletecustomer($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return redirect()->route('customer.login')->with('success', 'Customer Deleted Successfully !!');
        }
    }
    public function holdcustomer($id)
    {
        $customer = Customer::find($id);
        if ($customer->status == 1) {
            $customer->status = 0;
            $customer->save();
            return redirect()->back()->with(['success' => 'Customer hold successfully.']);
        } else {
            $customer->status = 1;
            $customer->save();
            return redirect()->back()->with(['success' => 'Customer activated successfully.']);
        }
    }
    public function chat()
    {
        $customer = Auth::guard('customer')->user();
        return view('frontend.customer.chat', compact('customer'));
    }
}
