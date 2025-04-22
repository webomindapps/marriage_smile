<section class="form-pad">
    <div class="container">
        <div class="row">
            <div class="box-wid">
                <h5 class="looking-p">I am Looking for a</h5>
                <div class="float_form">
                    <form action="{{ url('/') }}" method="GET">
                        <div class="row">
                            <div class="col-lg-2 col-6 pr-0">
                                <select name="gender" class="form-select form-right" required>
                                    <option value="" disabled selected>Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="col-lg-2 col-6 pr-lg-0 pr-0">
                                <select name="age_from" class="form-select form-right-noage" required>
                                    <option value="" disabled selected>Age From</option>
                                    @for ($i = 20; $i <= 30; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-lg-2 pr-lg-0 pr-0">
                                <select name="age_to" class="form-select form-right-noage" required>
                                    <option value="" disabled selected>Age To</option>
                                    @for ($i = 20; $i <= 30; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-lg-2 pr-lg-0 pr-0">
                                <select name="religion" class="form-select" required>
                                    <option value="" disabled selected>Religion</option>
                                    <option value="hindu">Hindu</option>
                                </select>
                            </div>

                            <div class="col-lg-2 pr-lg-0 pr-0">
                                <select name="mother_tongue" class="form-select form-right-nobord" required>
                                    <option value="" disabled selected>Mother tongue</option>
                                    <option value="kannada">Kannada</option>
                                    <option value="english">English</option>
                                    <option value="hindi">Hindi</option>
                                    <option value="telugu">Telugu</option>
                                    <option value="tamil">Tamil</option>
                                    <option value="malayalam">Malayalam</option>
                                </select>
                            </div>

                            <div class="col-lg-2 my-auto">
                                <input type="submit" value="Let’s Begin" class="book__now">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <hr>

    <!-- MATCHES SECTION -->
    @if (isset($matches))
        <div class="row mt-4">
            @foreach ($matches as $match)
                <div class="col-md-2 mb-4 ms-4">
                    <div class="card text-center p-3 shadow-sm">
                        <div class="card-img-container">
                            @php
                                $imageUrl = $match->documents->first()->image_url ?? 'default.jpg';
                            @endphp
                            <img src="{{ asset('storage/' . $imageUrl) }}"
                                class="{{ !Auth::guard('customer')->user() ? 'blurred' : '' }}"
                                alt="{{ $match->name }}">
                        </div>

                        <div class="card-body">
                            @if (!Auth::guard('customer')->user())
                                <h5 class="card-title blurred-text">Name Hidden</h5>
                                <p class="card-text blurred-text">Designation Hidden</p>
                                <a href="{{ route('customer.register') }}"
                                    class="btn btn-sm btn-outline-primary">Register to Continue </a>
                            @else
                                <h5 class="card-title">{{ $match->name }}</h5>
                                <p class="card-text">{{ $match->details->designation }}</p>
                                <p class="card-text">{{ $match->details->age }}Yrs</p>
                                <a href="{{ route('customer.matches') }}" onclick="showLimitReachedAlert();"
                                    class="btn btn-sm btn-outline-primary">ViewProfile</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <style>
        .blurred {
            filter: blur(6px);
            pointer-events: none;
        }

        .blurred-text {
            color: transparent;
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }
    </style>
</section>
