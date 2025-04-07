@extends('frontend.layouts.applayout')
@section('main')
    @push('styles')
        <link href="{{ asset('frontend/assets/css/search.css') }}" rel="stylesheet">
    @endpush
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-3">
                <x-Profilelayout />
            </div>
            <div class="col-lg-8 new-gp">
                <div class="row bo-filter">
                    <div class="col-lg-3">
                        <div class="bo-filter-box">
                            <ul class="list-unstyled">
                                <li><a href="#">All</a></li>
                                <li><a href="#">Unread</a></li>
                                <li><a href="#">Read</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
