<div>
    <div class="profile-per">
        <div class="row">
            <div class="col-lg-4">
                <img src="{{ $customer->documents?->first() ? asset('storage/' . $customer->documents?->first()->image_url) : asset('frontend/assets/images/default.jpg') }}"
                    class="img-fluid img-radi">
            </div>

            <div class="col-lg-8">

                <h4 class="pro-hea">Hi {{ explode(' ', $customer->name)[0] }}</h4>
                <h6 class="profile-des">
                    <strong> Customer Id:-{{ $customer->customer_id }}</strong>
                </h6>

                <h6 class="profile-des">
                    <a href="{{ route('customer.edit', $customer->id) }}">
                        <span class="co-editprofile">
                            <i class="fas fa-pencil"></i>
                            Edit Profile
                        </span>
                    </a>
                </h6>

            </div>
            @php
                $customerPlans = $customer->subscriptions->pluck('plan')->toArray();
            @endphp
            <div class="col-12 mt-4">
                <div class="border p-3 rounded" style="background-color: #ffffff;">
                    <h6><strong>Plan:-</strong></h6>
                    <h6 class="profile-des mb-0 d-flex flex-wrap gap-3">
                        @foreach ($plans as $plan)
                            <div class="border rounded px-2 py-2"
                                style="min-width: 40px;
                    text-align: center;
                    background-color: {{ in_array($plan->name, $customerPlans) ? '#f14a93b0' : '#f1f1f1' }};
                    color: {{ in_array($plan->name, $customerPlans) ? '#000' : '#333' }};
                    border: 1px solid black;">
                                {{ $plan->name }}
                            </div>
                        @endforeach
                    </h6>
                </div>
            </div>

            <div class="col-12">
                <div class="mt-4">
                    <p class="last-login btn btn-sm btn-outline-secondary w-100">
                        @if ($customer->last_login_time)
                            Last login:
                            {{ (new DateTime($customer->last_login_time))->setTimezone(new DateTimeZone('Asia/Kolkata'))->format('jS M g:i A') }}
                        @else
                            Last login: Not Available
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <hr>
        <!-- /////navigation vertical//// -->
        <nav class="nav flex-column">
            {{-- <a class="nav-link active" aria-current="page" href="{{ route('customer.profile') }}"> Dashboard <i
                    class="fa fa-chevron-right chev-icon"></i></a> --}}
            <a class="nav-link" aria-current="page" href="{{ route('customer.matches') }}"> Profiles <i
                    class="fa fa-chevron-right chev-icon"></i></a>
            <a class="nav-link" href="{{ route('customer.shortlist') }}">Short Listed Matches <i
                    class="fa fa-chevron-right chev-icon4"></i></a>
            <a class="nav-link" href="{{ route('friend.requests') }}">
                Received Requests <i class="fa fa-chevron-right chev-icon4"></i>
            </a>
        </nav>
        <!-- //// -->

    </div>
    <div class="profile-per mt-2">
        <nav class="nav flex-column">
            <a class="btn btn-danger" href="{{ route('customer.delete', $customer->id) }}"
                onclick="return confirm('Are you sure you want to delete this customer?');"> Delete
                Account</a>
            @if ($customer->status == 1)
                <a href="{{ route('customer.hold', $customer->id) }}" class="btn btn-danger mt-2"
                    onclick="return confirm('Are you sure to Hold  your profile from displaying ?');">Make Inactive</a>
            @else
                <a href="{{ route('customer.hold', $customer->id) }}" class="btn btn-success mt-2"
                    onclick="return confirm('Are you sure ?');">Activate Profile</a>
            @endif
            <a href="{{ route('customer.logout') }}" class="btn btn-secondary mt-2">Logout</a>

        </nav>
    </div>
</div>
