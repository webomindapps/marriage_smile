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
                        
                        <h4>Write Us</h4>
                        <form action="{{ route('guest.enquiry') }}" method="post">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control" required>

                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control" minlength="10"
                                    maxlength="15" oninput="this.value = this.value.replace(/\D/g, '')" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="message">What’s on your mind? <span class="text-danger">*</span></label>
                                <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-outline-secondary login-btn w-100 mb-3">Submit <i
                                        class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
