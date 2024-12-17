@extends('frontend.layouts.applayout')
@section('main')
    <div class="container secs">
        <div class="mx-auto col-lg-5 col-md-11 rounded shadow">
            <div class="login_box mt-5 p-3 mb-5">
                <h2 class="text-center text-green fw-bold mb-4">Reset Password</h2>
                <form action="{{ route('customer.password.reset') }}" method="POST">
                    <input type="hidden" name="reset_token" value="{{ $token }}">
                    @csrf
                    <p class="text-center">If you want to change your old password, reset it by entering your new
                        password.</p>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="{{ old('email', request()->query('email')) }}">
                        <label for="floatingInput">Email address</label>
                    </div>
                    @error('email')
                        <span style="font-size:12px;color:red;">{{ $message }}</span>
                    @enderror
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control input-password" id="floatingPassword"
                            placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        <span class="login-pass toggle-password"><i class='bx bx-hide'></i></span>
                    </div>
                    @error('password')
                        <span style="font-size:12px;color:red;">{{ $message }}</span>
                    @enderror
                    <div class="form-floating mb-3">
                        <input type="password" name="confirm_password" class="form-control input-password"
                            id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Confirm Password</label>
                        <span class="login-pass toggle-password"><i class='bx bx-hide'></i></span>
                    </div>
                    @error('confirm_password')
                        <span style="font-size:12px;color:red;">{{ $message }}</span>
                    @enderror
                    <div class="col-auto text-center">
                        <button type="submit" class="btn btn-outline-secondary login-btn w-100 mb-3">Reset
                            Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
