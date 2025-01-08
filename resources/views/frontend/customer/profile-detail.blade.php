@extends('frontend.layouts.applayout')
@section('main')
    @push('styles')
        <link href="{{ asset('frontend/assets/css/search.css') }}" rel="stylesheet">
        <style>
            .profile-detail .dp-img {
                max-height: 400px;
                width: 100%;
                object-fit: cover;
            }
        </style>
    @endpush
    <section class="dash-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <x-profilelayout />
                </div>

                <div class="col-lg-7 new-gp">
                    <div class="bg-white0 profile-detail">
                        <div class="pad-intrest">
                            <h4 class="pro-hea"><i class="fa fa-chevron-left cl-right "></i> Interests</h4>
                        </div>
                        @if ($customer->customer && $customer->customer->documents->isNotEmpty())
                            <img src="{{ asset('storage/' . $customer->customer->documents->first()->image_url) }}"
                                class="img-fluid dp-img">
                        @else
                            <img src="{{ asset('frontend/assets/images/profile-detailgirl.jpg') }}"
                                class="img-fluid dp-img">">
                        @endif
                        <div class="all-in-o">
                            <div class="pad-int-detail">
                                <p class="p-lastseen">Last seen on
                                    @if ($customer->customer->last_login_time)
                                        {{ \Carbon\Carbon::parse($customer->customer->last_login_time)->format('d-M-y') }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                                <h4 class="proview">{{ $customer->customer->name }}, <span
                                        class="">{{ $customer->age }} Age </span></h4>
                                <ul class="nav cl-family">
                                    <li class="nav-item">
                                        <a class="nav-link  active" aria-current="page" href="#about">About me</a>
                                    </li>
                                    <li class="nav-item"> <a class="nav-link" href="#family">Family</a></li>
                                    <li class="nav-item"> <a class="nav-link" href="#looking">Looking for</a> </li>

                                </ul>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-detaily">
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-circle-user-round">
                                                    <path d="M18 20a6 6 0 0 0-12 0" />
                                                    <circle cx="12" cy="10" r="4" />
                                                    <circle cx="12" cy="12" r="10" />
                                                </svg> <span>Profile managed by Parent</span>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-ruler">
                                                    <path
                                                        d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z" />
                                                    <path d="m14.5 12.5 2-2" />
                                                    <path d="m11.5 9.5 2-2" />
                                                    <path d="m8.5 6.5 2-2" />
                                                    <path d="m17.5 15.5 2-2" />
                                                </svg> <span>{{ $customer->height }}</span>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-flower">
                                                    <circle cx="12" cy="12" r="3" />
                                                    <path
                                                        d="M12 16.5A4.5 4.5 0 1 1 7.5 12 4.5 4.5 0 1 1 12 7.5a4.5 4.5 0 1 1 4.5 4.5 4.5 4.5 0 1 1-4.5 4.5" />
                                                    <path d="M12 7.5V9" />
                                                    <path d="M7.5 12H9" />
                                                    <path d="M16.5 12H15" />
                                                    <path d="M12 16.5V15" />
                                                    <path d="m8 8 1.88 1.88" />
                                                    <path d="M14.12 9.88 16 8" />
                                                    <path d="m8 16 1.88-1.88" />
                                                    <path d="M14.12 14.12 16 16" />
                                                </svg> <span>{{ $customer->religion }}</span>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-languages">
                                                    <path d="m5 8 6 6" />
                                                    <path d="m4 14 6-6 2-3" />
                                                    <path d="M2 5h12" />
                                                    <path d="M7 2h1" />
                                                    <path d="m22 22-5-10-5 10" />
                                                    <path d="M14 18h6" />
                                                </svg> <span>Mother tongue is {{ $customer->mother_tongue }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-detaily">
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-map-pinned">
                                                    <path d="M18 8c0 4.5-6 9-6 9s-6-4.5-6-9a6 6 0 0 1 12 0" />
                                                    <circle cx="12" cy="8" r="2" />
                                                    <path
                                                        d="M8.835 14H5a1 1 0 0 0-.9.7l-2 6c-.1.1-.1.2-.1.3 0 .6.4 1 1 1h18c.6 0 1-.4 1-1 0-.1 0-.2-.1-.3l-2-6a1 1 0 0 0-.9-.7h-3.835" />
                                                </svg> <span>{{ $customer->locations }}</span>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-badge-indian-rupee">
                                                    <path
                                                        d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
                                                    <path d="M8 8h8" />
                                                    <path d="M8 12h8" />
                                                    <path d="m13 17-5-1h1a4 4 0 0 0 0-8" />
                                                </svg> <span>Rs. {{ $customer->annual_income }}</span>
                                            </li>
                                            <li>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-file-heart">
                                                    <path d="M4 22h14a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v2" />
                                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                                    <path
                                                        d="M10.29 10.7a2.43 2.43 0 0 0-2.66-.52c-.29.12-.56.3-.78.53l-.35.34-.35-.34a2.43 2.43 0 0 0-2.65-.53c-.3.12-.56.3-.79.53-.95.94-1 2.53.2 3.74L6.5 18l3.6-3.55c1.2-1.21 1.14-2.8.19-3.74Z" />
                                                </svg> <span>{{ $customer->marritialstatus }}</span>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="row bo-filter4" id="about">
                                    <div class="col-md-2">
                                        <img src="{{ asset('frontend/assets/images/vishnuwithg.png') }}"
                                            class="img-fluid min-imh">
                                    </div>
                                    <div class="col-md-10">
                                        <h4 class="pro-hea"> It’s an 93% Match!</h4>
                                        <p class="last-showp">Based on mutual preferences</p>
                                    </div>

                                </div>
                                <div class="boi-dat">
                                    <p>I am looking for a suitable groom for my daughter.</p>
                                </div>

                                <div class="education">
                                    <h4>Education</h4>
                                    <img src="{{ asset('frontend/assets/images/icon1.png') }}"
                                        class="img-fluid code-imwidt">
                                    <span class="educat-head">{{ $customer->qualification }}</span>
                                </div>
                                <h4 class="conta-detail">Contact Details</h4>
                                <div class="cont-bg">
                                    <h4>Go Premium to contact matches </h4>
                                    <p>Inititate a voice or a video call with the profiles you like by upgrading to a
                                        membership</p>
                                    <a href="{{route('pricing')}}"><p class="requ-horoscope">Upgrade Now</p></a>

                                </div>

                                <div class="education">
                                    <h4>Career</h4>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset('frontend/assets/images/career.png') }}"
                                                class="img-fluid img-carer">
                                        </div>
                                        <div class="col-md-10 acou-profe">
                                            <h4 class="carrerh4">Accounting Professional</h4>
                                            <p class="careerp">Government/Public Sector</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- ////family/// -->
                                <div class="education" id="family">
                                    <h4>Family</h4>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset('frontend/assets/images/family.png') }}"
                                                class="img-fluid img-carer">
                                        </div>
                                        <div class="col-md-10 acou-profe">
                                            <h4 class="carrerh4">Middle Class Nuclear Family from Chennai/ Madras, Tamil
                                                Nadu, India</h4>
                                            <p class="careerp">Moderate values</p>
                                            <hr>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset('frontend/assets/images/father.png') }}"
                                                class="img-fluid img-carer">
                                        </div>
                                        <div class="col-md-10 acou-profe">
                                            <h4 class="carrerh4">Father is a {{ $customer->father_occupation }} & Mother
                                                is a {{ $customer->mother_occupation }}
                                            </h4>
                                            {{-- <p class="careerp">Earns Rs. 7.5 - 10 Lakh per Annum</p> --}}
                                        </div>

                                    </div>
                                </div>
                                <!-- ///end// -->
                                <!-- ///status/// -->
                                <div class="education">
                                    <h4>Kundali and Astro</h4>
                                    <img src="{{ asset('frontend/assets/images/kundli.png') }}"
                                        class="img-fluid code-imwidt">
                                    <span class="educat-head">
                                        @if ($customer->dob)
                                            {{ \Carbon\Carbon::parse($customer->dob)->format('M d,Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                    <p class="requ-horoscope">Request Horoscope</p>
                                </div>

                                <!-- ///status/// -->
                                <div class="education">

                                    <h4 class="margin-g">Expections</h4>
                                    <p class="careerp-h">{{$customer->expectations}}</p>

                                </div>

                                {{-- <img src="{{ asset('frontend/assets/images/preference.png') }}" class="img-fluid">
                                <div class="basic-det" id="looking">
                                    <h5>Basic Details</h5>
                                </div>

                                <div class="row ">
                                    <div class="col-md-10">
                                        <h4 class="heig-h4"> Height</h4>
                                        <p class="heigh-p">5' 5" to 6' 3" </p>
                                    </div>
                                    <div class="col-md-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                            viewBox="0 0 24 24" fill="none" stroke="#1ba300" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                                            <path d="M20 6 9 17l-5-5" />
                                        </svg>
                                    </div>
                                </div>
                                <hr class="lin-profile">
                                <div class="row ">
                                    <div class="col-md-10">
                                        <h4 class="heig-h4"> Age</h4>
                                        <p class="heigh-p">24 to 31 Years </p>
                                    </div>
                                    <div class="col-md-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                            viewBox="0 0 24 24" fill="none" stroke="#1ba300" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                                            <path d="M20 6 9 17l-5-5" />
                                        </svg>
                                    </div>
                                </div>
                                <hr class="lin-profile">
                                <div class="row ">
                                    <div class="col-md-10">
                                        <h4 class="heig-h4"> Mother Tongue</h4>
                                        <p class="heigh-p">Tamil</p>
                                    </div>
                                    <div class="col-md-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                            viewBox="0 0 24 24" fill="none" stroke="#1ba300" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                                            <path d="M20 6 9 17l-5-5" />
                                        </svg>
                                    </div>
                                </div>
                                <hr class="lin-profile">
                                <div class="row ">
                                    <div class="col-md-10">
                                        <h4 class="heig-h4"> Religion</h4>
                                        <p class="heigh-p">Hindu, Jain </p>
                                    </div>
                                    <div class="col-md-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                            viewBox="0 0 24 24" fill="none" stroke="#1ba300" stroke-width="2.5"
                                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                                            <path d="M20 6 9 17l-5-5" />
                                        </svg>
                                    </div>
                                </div>

                                <div class="basic-det">
                                    <h5>Desired Education & Occupation</h5>
                                    <h4 class="heig-h4"> Earning</h4>
                                    <p class="heigh-p">Rs.2 Lakh and above, $25,001 and above </p>
                                </div> --}}


                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-lg-2">
                    <img src="{{ asset('frontend/assets/images/advertise.jpg') }}" class="img-fluid clas-to1">
                    <img src="{{ asset('frontend/assets/images/advert2.jpg') }}" class="img-fluid clas-to1">
                </div>
            </div>
        </div>
    </section>
@endsection
