<div>
    <div class="profile-per">
        <div class="row">
            <div class="col-lg-4">
                <img src="{{ $customer->documents->first() ? asset('storage/' . $customer->documents->first()->image_url) : asset('frontend/assets/images/default.jpg') }}"
                    class="img-fluid img-radi">
            </div>

            <div class="col-lg-8">

                <h4 class="pro-hea">Hi {{ $customer->name }}</h4>
                <h6 class="profile-des">
                    {{ $customer->customer_id }}
                    <span class="co-editprofile">
                        <div class="dropdown d-inline">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"
                                style="color: red;">Dashboard</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.customer.edit', $customer->id) }}">
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Are you sure you want to delete this customer?');">
                                        Delete
                                    </button>
                                </li>
                                <li>
                                    <a class="dropdown-item">
                                        Hold
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @if ($customer->last_login_time)
                        <p class="last-login btn btn-sm btn-outline-secondary">
                            Last login: {{ \Carbon\Carbon::parse($customer->last_login_time)->format('jS M g:i A') }}
                        </p>
                    @else
                        <p class="last-login btn btn-sm btn-outline-secondary">
                            Last login: Not Available
                        </p>
                    @endif
                    
                    </span>
                </h6>


            </div>

        </div>
        <hr>
        <!-- /////navigation vertical//// -->
        <nav class="nav flex-column">
            {{-- <a class="nav-link active" aria-current="page" href="{{ route('customer.profile') }}"> Dashboard <i
                    class="fa fa-chevron-right chev-icon"></i></a> --}}
            <a class="nav-link" aria-current="page" href="{{ route('customer.matches') }}"> Profiles <i
                    class="fa fa-chevron-right chev-icon"></i></a>
            <a class="nav-link" href="#">Short Listed Matches <i class="fa fa-chevron-right chev-icon4"></i></a>
            <a class="nav-link" href="#">Received Requests <i class="fa fa-chevron-right chev-icon4"></i></a>
        </nav>
        <!-- //// -->
    </div>
</div>
