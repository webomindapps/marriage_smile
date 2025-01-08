@extends('frontend.layouts.applayout')
@section('main')
    @push('styles')
        <link href="{{ asset('frontend/assets/css/search.css') }}" rel="stylesheet">
    @endpush
    <section class="dash-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <x-profilelayout />
                </div>
                <div class="col-lg-8 new-gp">
                    <div class="bg-white-search">
                        <h3>Received Requests:-</h3>
                        @foreach ($requests as $request)
                            <div class="border p-3 mb-3 d-flex rounded">
                                <div class="picture">
                                    <img src="{{ $request->sender->documents->first() ? asset('storage/' . $request->sender->documents->first()->image_url) : asset('frontend/assets/images/default.jpg') }}"
                                        class="img-fluid img-radi" style="width: 60px; height: 60px;" alt="">
                                </div>
                                <div class="content">
                                    <p>{{ $request->sender?->name }}</p>
                                    <a class="btn btn-sm btn-success" href="{{route('accept.request',$request->id)}}">Accept</a>
                                    <a class="btn btn-sm btn-danger" href="{{route('reject.request',$request->id)}}">Reject</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
