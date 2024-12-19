<div>
    <div class="profile-per">
        <div class="row">
            <div class="col-lg-4">


                <img src="{{ asset('frontend/assets/images/vishnu.jpg') }}" class="img-fluid img-radi">
            </div>
            <div class="col-lg-8">

                <h4 class="pro-hea">Hi {{$customer->name}}</h4>
                <h6 class="profile-des">{{$customer->customer_id}} <span class="co-editprofile"> Edit Profile</span></h6>

            </div>
        </div>
        <hr>
        <!-- /////navigation vertical//// -->
        <nav class="nav flex-column">
            <a class="nav-link active" aria-current="page" href="{{ route('customer.profile') }}"> Dashboard <i
                    class="fa fa-chevron-right chev-icon"></i></a>
            <a class="nav-link" aria-current="page" href="{{ route('customer.matches') }}"> Profiles <i
                    class="fa fa-chevron-right chev-icon"></i></a>
            <a class="nav-link" href="#">Short Listed Matches <i class="fa fa-chevron-right chev-icon4"></i></a>
            <a class="nav-link" href="#">Add Requests <i class="fa fa-chevron-right chev-icon4"></i></a>
        </nav>
        <!-- //// -->
    </div>
</div>
