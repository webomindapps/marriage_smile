<header class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="wrapper" id="menu-bar">
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

                        <span class="overlay">

                        </span>
                    </div>
                    <div class="left-area col-lg-9">
                        <nav class="navbar" id="navbar">
                            <a href="{{ url('/') }}" class="brand-nav" contenteditable="false"
                                style="cursor: pointer;">
                                <img src="images/logo-byte-brust.png" class="img-fluid" alt="">
                            </a>
                            <div class="close" id="closeMenu">
                                <i class="fal fa-times"></i>
                            </div>
                            <ul class="menu" id="menu">


                                <li class="menu-item">
                                    <a href="{{ url('/') }}" class="menu-link" contenteditable="false"
                                        style="cursor: pointer;">Home</a>
                                </li>

                                <li class="menu-item">
                                    <a href="#" class="menu-link" contenteditable="false"
                                        style="cursor: pointer;"> Browse Profile</a>
                                </li>
                                <li class="menu-item">
                                    <a href="search.php" class="menu-link" contenteditable="false"
                                        style="cursor: pointer;"> Search</a>
                                </li>


                                <li class="menu-item">
                                    <a href="{{ route('customer.login') }}" class="header-btns login-btn"
                                        contenteditable="false" style="cursor: pointer;">Login</a>
                                </li>



                            </ul>

                        </nav>
                        <a href="{{ route('customer.register') }}" class="header-btns h-btn" contenteditable="false"
                            style="cursor: pointer;">Register</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
