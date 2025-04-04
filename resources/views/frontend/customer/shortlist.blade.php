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
                        <h3>Shortlist Profiles:-</h3>
                        @foreach ($shortlist as $list)
                            @php
                                // Get the first document from the collection
                                $document = $list->customer->documents->first();
                            @endphp
                            <div class="border p-3 mb-3 d-flex rounded">
                                <div class="position-relative bg-white">
                                    <a onclick="return confirm('Are you sure you want to remove?')"
                                        href="{{ route('shortlist.remove', $list->id) }}"
                                        class="position-absolute top-0 end-0" style="z-index: 1;">
                                        <i class='bx bxs-trash p-2 m-1 bg-danger rounded text-white'></i>
                                    </a>
                                    @if ($list->customer)
                                        <a href="{{ route('customer.details', $list->customer->id) }}"
                                            class="text-decoration-none">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $document->image_url ?? 'frontend/assets/images/default-profile.png') }}"
                                                    alt="Profile Picture" class="rounded-circle me-3" width="50"
                                                    height="50">
                                                <div>
                                                    <h5 class="mb-1">{{ $list->customer->name }}</h5>
                                                    <p class="mb-0 text-muted">{{ $list->customer->email }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
