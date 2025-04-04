@extends('frontend.layouts.applayout')
@push('styles')
    <link href="{{ asset('frontend/assets/css/pricing.css') }}" rel="stylesheet">
@endpush
@section('main')
    <section class="dash-pad mt-2 mb-4">
        <div class="container">
            <div class="row">
                <h2 class="cl-h3">Our Subscription Plans</h2>
                <div class="container bg-light ">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="card bg-warning border-0 rounded-0 shadow hei-3">
                                <div class="card-header text-center text-white border-0">
                                    <h2><strong>Basic</strong></h2>
                                    <p>Free <br>Members</p>

                                </div>
                                <div class="card-body bg-white">
                                    <ul class="list-unstyled">
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>3 Months</strong> Validity
                                        </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i> Name
                                            Access</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>10</strong> Photo Access
                                        </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>5</strong> Profiles can Access with all details
                                        </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>5</strong> Horoscope Access
                                        </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>5</strong> Chats With Bride or Groom
                                        </li>

                                        <li class="mb-4"><i class="fa fa-lg fa-times-circle text-secondary mr-2"></i>
                                            Dedicated Executive from Marriage Smile for coordination</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-times-circle text-secondary mr-2"></i>
                                            Weekly updates from Marriage Smile Team</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-times-circle text-secondary mr-2"></i> New
                                            Profiles email alerts </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-times-circle text-secondary mr-2"></i>
                                            Quarterly Online Meetings</li>
                                    </ul>
                                    <!--  <p class="text-center font-weight-bolder text-dark h1 display-4 mb-0">$3</p>
                                    <p class="small text-center font-weight-bolder text-secondary">per month</p> -->
                                    <a href="{{ route('subscribe') }}" class="btn btn-block bg-warning text-white">Contact
                                        Us</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="card bg-success border-0 rounded-0 shadow hei-3">
                                <div class="card-header text-center text-white border-0">

                                    <h2><strong>Plan S</strong></h2>
                                    <p>2999<br>
                                        1499 ( Inc GST) </p>
                                </div>
                                <div class="card-body bg-white">
                                    <ul class="list-unstyled">
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>1 Year</strong> Validity
                                        </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i> Name
                                            Access</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>1000</strong> Photo Access
                                        </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>01 Year / 599 </strong> Profiles can Access with all details
                                        </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            Horoscope Access</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i> Chats
                                            With Bride or Groom</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-times-circle text-secondary mr-2"></i>
                                            Dedicated Executive from Marriage Smile for coordination </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-times-circle text-secondary mr-2"></i>
                                            Weekly updates from Marriage Smile Team</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-times-circle text-secondary mr-2"></i> New
                                            Profiles email alerts </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            Quarterly Online Meetings</li>
                                    </ul>




                                    <a href="{{ route('subscribe') }}" class="btn btn-block bg-success text-white">Buy
                                        Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card bg-info border-0 rounded-0 shadow hei-3">
                                <div class="card-header text-center text-white border-0">
                                    <h2><strong>Plan M</strong></h2>
                                    <p>6999<br>
                                        4999 ( Inc GST)</p>


                                </div>
                                <div class="card-body bg-white">
                                    <ul class="list-unstyled">
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>1 Year</strong> Validity
                                        </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i> Name
                                            Access</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>Unlimited</strong>
                                        </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            <strong>01 Year / 899 </strong> Profiles can Access with all details
                                        </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            Horoscope Access</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i> Chats
                                            With Bride or Groom</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            Dedicated Executive from Marriage Smile for coordination </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i> Weekly
                                            updates from Marriage Smile Team</li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i> New
                                            Profiles email alerts </li>
                                        <li class="mb-4"><i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                            Quarterly Online Meetings </li>
                                    </ul>

                                    <a href="{{ route('subscribe') }}" class="btn btn-block bg-success text-white">Buy
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
