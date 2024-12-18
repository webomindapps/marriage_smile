@extends('frontend.layouts.applayout')
@section('main')
    <div class="container secs">
        <div class="mx-auto col-lg-5 col-md-11 rounded shadow">
            <div class="login_box mt-5 p-3 mb-5">
                <h2 class="text-center text-green fw-bold mb-4">Forgot Password</h2>
                <form action="{{ route('customer.forgot-password') }}" method="POST">
                    @csrf
                    <p class="text-center">If you have forgotten your password, recover it by entering your email
                        address.</p>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="{{ old('email') }}">
                        <label for="floatingInput">Email address</label>
                    </div>
                    @error('email')
                        <span style="font-size: 13px;color:red;">{{ $message }}</span>
                    @enderror
                    <div class="col-auto text-center">
                        <button type="submit" class="btn  forgot-btn w-100 mb-3">Send Password reset Email </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
