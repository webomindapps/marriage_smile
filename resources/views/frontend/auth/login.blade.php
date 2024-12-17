@extends('frontend.layouts.applayout')
@section('main')
    @push('styles')
        <link href="{{ asset('frontend/assets/css/login.css') }}" rel="stylesheet">
    @endpush
    <section class="register-f">
        <div class="container">
            <div class="row">
                <div class="col-lg-6"></div>

                <div class="col-lg-6 d-flex align-items-center justify-content-center right-side">
                    <div class="form-2-wrapper">
                        <div class="logo text-center">
                        </div>
                        <h2 class="text-center mb-4 sign-account">Sign Into Your Account</h2>
                        <form action="{{ route('customer.login') }}" method="POST">
                            @csrf
                            @if (session('danger'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('danger') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('verify'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('verify') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="mb-3 form-box">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter Your Email/Customer id" required="">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter Your Password" required="">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                    <a href="{{ route('customer.forgot-password') }}" class="text-decoration-none float-end"
                                        contenteditable="false" style="cursor: pointer;">Forget Password</a>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-outline-secondary login-btn w-100 mb-3">Login</button>
                            <div class="social-login mb-3 type--A">
                                <h5 class="text-center mb-3">Social Login</h5>
                                <button class="btn btn-outline-secondary  mb-3"> Sign With Google</button>
                                <button class="btn btn-outline-secondary mb-3"> Sign With Facebook</button>
                            </div>
                        </form>

                        <!-- Register Link -->
                        <p class="text-center register-test mt-3">Don't have an account ? <a
                                href="{{ route('customer.register') }}" class="text-decoration-none" contenteditable="false"
                                style="cursor: pointer;"> Register
                                here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
