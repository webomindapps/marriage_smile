<div>
    <div class="profile-per">
        <div class="row">
            <div class="col-lg-4">
                <img src="{{ $customer->documents?->first() ? asset('storage/' . $customer->documents?->first()->image_url) : asset('frontend/assets/images/default.jpg') }}"
                    class="img-fluid img-radi">
            </div>

            <div class="col-lg-8">

                <h4 class="pro-hea">Hi {{ $customer->name }}</h4>
                <h6 class="profile-des">
                    {{ $customer->customer_id }}
                    <a href="{{ route('customer.edit', $customer->id) }}">
                        <span class="co-editprofile">
                            <i class="fas fa-pencil"></i>
                            Edit Profile
                        </span>
                    </a>
                </h6>
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
                <a href="{{ route('customer.hold', $customer->id) }}" class="btn btn-info mt-2"
                    onclick="return confirm('Are you sure to Hold  your profile from displaying ?');">Hold</a>
            @else
                <a href="{{ route('customer.hold', $customer->id) }}" class="btn btn-info mt-2"
                    onclick="return confirm('Are you sure ?');">Active</a>
            @endif
            <a href="{{ route('customer.logout') }}" class="btn btn-secondary mt-2">Logout</a>

        </nav>
    </div>
</div>
