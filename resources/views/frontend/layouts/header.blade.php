<header class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="wrapper" id="menu-bar">
                    <!-- Mobile Header -->
                    <div class="col-lg-3 col-12 mbl-header">
                        <a href="{{ url('/') }}" class="brand" contenteditable="false" style="cursor: pointer;">
                            <img src="{{ asset('frontend/assets/images/logo.png') }}" class="img-fluid"
                                alt="digital customer service">
                        </a>
                        <div class="burger" id="burger">
                            <span class="burger-line"></span>
                            <span class="burger-line"></span>
                            <span class="burger-line"></span>
                        </div>
                        <span class="overlay"></span>
                    </div>

                    <!-- Navigation Menu -->
                    <div class="left-area col-lg-7">
                        <nav class="navbar" id="navbar">
                            <ul class="menu" id="menu">
                                <li class="menu-item">
                                    <a href="{{ url('/') }}" class="menu-link" contenteditable="false"
                                        style="cursor: pointer;">Home</a>
                                </li>
                                @php
                                    $customer = Auth::guard('customer')->user();
                                @endphp

                                @if (is_null($customer))
                                    <li class="menu-item">
                                        <a href="#" class="menu-link" contenteditable="false"
                                            style="cursor: pointer;">Browse Profile</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="search.php" class="menu-link" contenteditable="false"
                                            style="cursor: pointer;">Search</a>
                                    </li>

                                    <li class="menu-item">
                                        <a href="{{ route('customer.login') }}" class="header-btns login-btn"
                                            contenteditable="false" style="cursor: pointer;">Login</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('customer.register') }}" class="header-btns h-btn"
                                            contenteditable="false" style="cursor: pointer;">Register</a>
                                    </li>
                                @else
                                    <li class="menu-item">
                                        <ul class="right-icons" style="list-style: none;">
                                            <li class="dropdown account-dropdown">
                                                <a id="account-dropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                                    class="dropdown-toggle">
                                                    <i class="far fa-user-circle userIcon"></i>
                                                    {{ explode(' ', $customer->name)[0] }}
                                                </a>
                                                <ul aria-labelledby="account-dropdown"
                                                    class="dropdown-menu account-dropdown-menu">
                                                    <li class="dropdown-item">
                                                        <a href="{{ route('customer.matches') }}">
                                                            Dashboard
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="{{ route('admin.customer.edit', $customer->id) }}">
                                                            Edit Profile
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="{{ route('customer.logout') }}">Logout</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
