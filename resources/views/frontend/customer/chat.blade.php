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
            <div class="col-lg-9">
                <div class="row w-100 border p-2 rounded" id="app">
                    <chat-box :receiver_per="" :receiver="{{ $customer }}" :sender_per="" :sender="{{ $sender }}" /></chat-box>
                </div>
            </div>
        </div>
    </div>
@endsection
