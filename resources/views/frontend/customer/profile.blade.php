@extends('frontend.layouts.applayout')
@section('main')
    @push('styles')
        <link href="{{ asset('frontend/assets/css/search.css') }}" rel="stylesheet">
    @endpush
    <section class="dash-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="profile-per">
                        <div class="row">
                            <div class="col-lg-4">


                                <img src="{{asset('frontend/assets/images/vishnu.jpg')}}" class="img-fluid img-radi">
                            </div>
                            <div class="col-lg-8">

                                <h4 class="pro-hea">Hi Vishnu!</h4>
                                <h6 class="profile-des">UXUA7681 <span class="co-editprofile"> Edit Profile</span></h6>

                            </div>
                        </div>
                        <hr>
                        <!-- /////navigation vertical//// -->
                        <nav class="nav flex-column">
                            <a class="nav-link active" aria-current="page" href="dashboard.php"> Matches <i
                                    class="fa fa-chevron-right chev-icon"></i></a>

                            <a class="nav-link" href="#">Activity <i class="fa fa-chevron-right chev-icon1"></i></a>
                            <a class="nav-link" href="search.php">Search <i class="fa fa-chevron-right chev-icon2"></i></a>
                            <a class="nav-link " href="#">Messenger <i class="fa fa-chevron-right chev-icon3"></i></a>
                            <a class="nav-link" href="#">Upgrade <i class="fa fa-chevron-right chev-icon4"></i></a>
                        </nav>
                        <!-- //// -->
                    </div>
                </div>

                <div class="col-lg-7 new-gp">
                    <div class="bg-white-search">

                        <div class="tab-class">
                            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="ex1-tab-1" data-bs-toggle="tab" href="#ex1-tabs-1"
                                        role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Search by
                                        Criteria</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="ex1-tab-2" data-bs-toggle="tab" href="#ex1-tabs-2"
                                        role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Search by Profile
                                        ID</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="ex1-content">
                                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel"
                                    aria-labelledby="ex1-tab-1">
                                    <!-- ///start search details// -->


                                    <div class="row ">
                                        <div class="col-md-10">

                                            <h4 class="heig-h4"> Age</h4>
                                            <p class="heigh-p">24 to 31 Years </p>
                                        </div>

                                    </div>
                                    <hr class="hf">
                                    <div class="row ">
                                        <!-- <div class="col-md-10">
                        <h4 class="heig-h4"> Height</h4>
                        <p class="heigh-p">4' 6" (1.37 mts) - 5' 5" (1.65 mts) </p>
                          </div> -->

                                    </div>

                                    <hr class="hf">
                                    <h4 class="heig-h4"> Merital Status</h4>
                                    <div class="byn">
                                        <button class="btn btn-outline-secondary  mb-3"> Doesn't Matter</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Never Married</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Awaiting Divorce</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Divorced</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Widowed</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Annulled</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Married</button>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-10">
                                            <h4 class="heig-h4">Education</h4>
                                            <p class="heigh-p">Doesn't Matter </p>
                                        </div>

                                    </div>
                                    <div class="row ">
                                        <div class="col-md-10">
                                            <h4 class="heig-h4">Occupation</h4>
                                            <p class="heigh-p">Doesn't Matter </p>
                                        </div>

                                    </div>

                                    <h4 class="heig-h4">Religion</h4>
                                    <div class="byn">
                                        <button class="btn btn-outline-secondary  mb-3"> Doesn't Matter</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Hindu</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Muslim</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Sikh</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Christian</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Buddhist</button>
                                        <button class="btn btn-outline-secondary  mb-3">Jain</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Parsi</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Bahai</button>


                                    </div>
                                    <div class="row ">
                                        <div class="col-md-10">
                                            <h4 class="heig-h4"> Height</h4>
                                            <p class="heigh-p">4' 6" (1.37 mts) - 5' 5" (1.65 mts) </p>
                                        </div>

                                    </div>
                                    <h4 class="heig-h4"> Have Children</h4>
                                    <div class="byn">
                                        <button class="btn btn-outline-secondary  mb-3"> Doesn't Matter</button>
                                        <button class="btn btn-outline-secondary  mb-3"> No</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Yes - Living together</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Yes - Living separately</button>

                                    </div>
                                    <div class="row ">
                                        <div class="col-md-10">
                                            <h4 class="heig-h4">Caste</h4>
                                            <p class="heigh-p">Others, Pillai, +22 More </p>
                                        </div>

                                    </div>
                                    <hr class="hf">
                                    <div class="row ">
                                        <div class="col-md-10">
                                            <h4 class="heig-h4">Mother Tongue</h4>
                                            <p class="heigh-p">Doesn't Matter </p>
                                        </div>

                                    </div>
                                    <hr class="hf">
                                    <div class="row ">
                                        <div class="col-md-10">
                                            <h4 class="heig-h4">Annual Income</h4>
                                            <p class="heigh-p">Rs. 0 - and above</p>
                                        </div>

                                    </div>
                                    <hr class="hf">
                                    <div class="row ">
                                        <div class="col-md-10">
                                            <h4 class="heig-h4">Country</h4>
                                            <p class="heigh-p">Doesn't Matter</p>
                                        </div>

                                    </div>
                                    <hr class="hf">
                                    <h4 class="heig-h4">Residential Status</h4>
                                    <div class="byn">
                                        <button class="btn btn-outline-secondary  mb-3"> Doesn't Matter</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Citizen</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Permanent Resident</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Work Permit</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Student Visa</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Temporary Visa</button>
                                    </div>
                                    <h4 class="heig-h4">Diet</h4>
                                    <div class="byn">
                                        <button class="btn btn-outline-secondary  mb-3"> Doesn't Matter</button>
                                        <button class="btn btn-outline-secondary  mb-3">Vegetarian</button>
                                        <button class="btn btn-outline-secondary  mb-3">Non Vegetarian</button>
                                        <button class="btn btn-outline-secondary  mb-3">Eggetarian</button>

                                    </div>
                                    <h4 class="heig-h4">Show Profile</h4>
                                    <div class="byn">
                                        <button class="btn btn-outline-secondary  mb-3"> All Profiles</button>
                                        <button class="btn btn-outline-secondary  mb-3"> Profile with photos</button>

                                    </div>


                                    <hr class="hf">

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn bt-register">Show Me Profiles</button>
                                    </div>
                                    <!-- ////end// -->
                                </div>
                                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                    <form class="row ne-id-search">


                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="inputEmail4"
                                                placeholder="Enter Profile ID">
                                        </div>

                                    </form>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn bt-register">Show Me Profiles</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-lg-2">
                    <img src="{{asset('frontend/assets/images/advertise.jpg')}}" class="img-fluid clas-to1">
                    <img src="{{asset('frontend/assets/images/advert2.jpg')}}" class="img-fluid clas-to1">
                </div>
            </div>
        </div>
    </section>
@endsection
