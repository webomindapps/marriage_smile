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
use App\Models\CustomerImage;
use App\Models\Horoscope;
use App\Models\Shortlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\SubscriptionValidation;
use Barryvdh\DomPDF\Facade\Pdf;
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
            'image_url' => 'nullable|array',
            'image_url.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'image_path' => 'required|array',
            'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

            if ($request->hasFile('image_path')) {
                $imagepaths = $request->file('image_path');

                foreach ($imagepaths as $imagepath) {

                    if ($imagepath instanceof \Illuminate\Http\UploadedFile) {
                        $paths = $imagepath->store('documents/horoscope', 'public');

                        $customer->horoscope()->create([
                            'customer_id' => $customer->id,
                            'image_path' => $paths,
                        ]);
                    }
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
                'hobbies',
                'marritialstatus',
                'father_name',
                'mother_name',
                'father_occupation',
                'mother_occupation',
                'siblings',
                'locations',
                // 'present_house_status',
                // 'permanent_locations',
                // 'permanent_house_status',
                // 'asset_value',
                // 'preferreday',
                // 'timings',
                // 'preferred_contact_no',
                // 'contact_related_to',
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

            //validating the first 3000 customers
            $customerCount = Customer::count();


            if ($customerCount < 3000) {

                $basicPlan = PlanPrice::whereHas('priceplans', function ($q) {
                    $q->where('name', 'Plan M');
                })->first();
            } else {
                $basicPlan = PlanPrice::whereHas('priceplans', function ($q) {
                    $q->where('name', 'Basic');
                })->first();
            }




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

            $featureValues = [
                'photo_viewable' => 0,
                'profile_viewable' => 0,
                'chat_viewable' => null,
            ];

            foreach ($plan->features as $feature) {
                switch ($feature->name) {
                    case 'photo_viewable':
                        $featureValues['photo_viewable'] = $feature->feature_value ?? 0; // or use $feature->pivot->value
                        break;

                    case 'profile_viewable':
                        $featureValues['profile_viewable'] = $feature->feature_value ?? 0;
                        break;

                    case 'chat_viewable':
                        $featureValues['chat_viewable'] = $feature->feature_value ?? 0;
                        break;
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

            return redirect()->back()->with('registration_success', true);
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
            'image_path' => 'required|array',
            'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_url.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        DB::beginTransaction();

        try {
            // Update customer basic details
            $customerData = $request->only(['name', 'email', 'phone']);
            $customer->update($customerData);

            // Update documents
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

            if ($request->hasFile('image_path')) {
                $imagepaths = $request->file('image_path'); // This should be an array of file objects

                foreach ($imagepaths as $imagepath) {
                    // Check if the file is an instance of UploadedFile
                    if ($imagepath instanceof \Illuminate\Http\UploadedFile) {
                        $paths = $imagepath->store('documents/horoscope', 'public');

                        $customer->horoscope()->create([
                            'customer_id' => $customer->id,
                            'image_path' => $paths,
                        ]);
                    }
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

            return redirect()->route('customer.matches', $id)->with('success', 'Customer updated successfully');
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

    public function matches(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        $oppositeGender = $customer->details->gender === 'male' ? 'female' : 'male';

        // Start the query
        $query = CustomerDetails::with(['customer.documents'])
            ->where('gender', $oppositeGender)
            ->whereHas('customer', function ($q) use ($request) {
                $q->where('status', 1);
            });
        // Check and apply filters
        if ($request->filled('customer_id')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('customer_id', $request->customer_id); // this filters by customer_id like 'MS003'
            });
        }


        if ($request->filled('name')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('age_from') || $request->filled('age_to')) {
            $ageFrom = (int) ($request->age_from ?? 18);
            $ageTo = (int) ($request->age_to ?? 100);
            $query->whereBetween('age', [$ageFrom, $ageTo]);
        }

        // Make sure the marital status condition is using the correct request key
        if ($request->filled('marritialstatus') && $request->marritialstatus !== "Doesn't Matter") {
            $query->where('marritialstatus', $request->marritialstatus);
        }

        if ($request->filled('height')) {
            $query->where('height', $request->height);
        }

        if ($request->filled('qualification')) {
            $query->where('qualification', $request->qualification);
        }

        // Paginate results
        $profile_details = $query->paginate(10);

        // Fetch necessary additional data
        $subscription = SubscriptionValidation::where('customer_id', $customer->id)->first();
        $viewedProfileIds = ProfileViewable::where('customer_id', Auth::guard('customer')->id())
            ->pluck('profile_id')
            ->toArray();
        $duration = Subscription::where('customer_id', $customer->id)
            ->where('status', 1)
            ->latest()
            ->first();
        $shortlistedIds = Shortlist::where('customer_id', Auth::guard('customer')->id())
            ->pluck('profile_id') // adjust field name if different
            ->toArray();
        // Return view with filtered results
        return view('frontend.customer.matches', compact('profile_details', 'subscription', 'viewedProfileIds', 'duration', 'shortlistedIds'));
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

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
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
    public function downloadPdf($id)
    {
        $customers = CustomerDetails::with('customer')->where('customers_id', $id)->firstOrFail();

        $pdf = Pdf::loadView('frontend.pdf.customer-details', compact('customers'));

        return $pdf->download('MS-customer-details-' . $customers->customer->customer_id . '.pdf');
    }

    public function deletehoroscope($id)
    {
        $horoscope = Horoscope::find($id);
        $horoscope->delete();
        return redirect()->back()->with('success', 'Horoscope Deleted Sucessfully');
    }
    public function deletedocuments($id)
    {
        $document = CustomerImage::find($id);
        $document->delete();
        return redirect()->back()->with('success', 'Documents Deleted Successfully');
    }
}
