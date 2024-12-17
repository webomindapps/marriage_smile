<div class="container-fluid brdcrumb bg-light">
    <div class="col-md-12 mt-3 mb-5">
        <nav aria-label="breadcrumb" class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </nav>
        <div class="container">
            <h2 class="brd_heading">Welcome {{ $customer->name }}</h2>
        </div>
    </div>
</div>
<div class="container-fluid account_page ">
    <div class="container secs">
        <div class="col-12 d-flex">
            <a href="" class="btn w-100 filter-btn shadow-none border mb-2 d-md-none d-block">
                Account settings <i class="bx bx-filter"></i>
            </a>
            <div class="sidebar">
                <a href=""
                    class="btn w-100 filter-btn shadow-none border d-flex justify-content-between align-itmes-center mb-2 d-md-none d-block bg-danger text-white">
                    My Account <i class="bx bx-x fs-4"></i>
                </a>
                <ul class="list-group">
                    <div class="avatar_box border d-flex">
                        <img src="{{ asset('frontend/images/dummy-profile.png') }}" alt=""
                            class="img-fluid circle">
                        <div class="avatar_details">
                            <h3>{{ $customer?->name . ' ' . $customer?->lastname }} </h3>
                        </div>
                    </div>
                    <li class="list-group-item {{ request()->routeIs('customer.profile') ? 'active' : '' }}">
                        <a href="{{ route('customer.profile') }}" class="d-block">
                            <i class='bx bx-user-circle me-2'></i>My Details
                        </a>
                    </li>
                    {{-- <li class="list-group-item {{ request()->routeIs('customer.address') ? 'active' : '' }}">
                        <a href="{{ route('customer.address') }}" class="d-block">
                            <i class='bx bx-map me-2'></i> Address
                        </a>
                    </li> --}}
                    <li class="list-group-item {{ request()->routeIs('customer.orders') ? 'active' : '' }}">
                        <a href="{{route('customer.orders')}}" class="d-block">
                            <i class='bx bx-shopping-bag me-2'></i> Your Orders
                        </a>
                    </li>
                    <li class="list-group-item {{ request()->routeIs('customer.wishlist') ? 'active' : '' }}">
                        <a href="{{route('customer.wishlist')}}" class="d-block">
                            <i class='bx bx-heart me-2'></i> Wishlist
                        </a>
                    </li>
                    <hr>
                    <li class="list-group-item">
                        <a href="{{route('customer.logout')}}" class="d-block">
                            <i class='bx bx-log-out me-2'></i> Log out
                        </a>
                    </li>
                </ul>
            </div>
            <div class="account_details ps-5">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
