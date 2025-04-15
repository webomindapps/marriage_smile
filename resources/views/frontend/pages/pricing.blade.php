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
                        @foreach ($plans as $plan)
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card bg-warning border-0 rounded-0 shadow hei-3">
                                    <div class="card-header text-center text-white border-0">
                                        <h3><strong>{{ $plan->name }}</strong></h3>
                                        @foreach ($plan->prices as $price)
                                            <h6>
                                                {!! $price->price == 0 ? 'Free' : '<del>₹' . $price->price . '</del>' !!}
                                            </h6>
                                            <h5>
                                                {{ $price->special_price == 0 ? 'Member' : '₹' . $price->special_price . ' ( Inc GST )' }}
                                            </h5>
                                        @endforeach
                                    </div>
                                    <div class="card-body bg-white">
                                        <ul class="list-unstyled">
                                            {{-- Duration --}}
                                            @foreach ($plan->prices as $price)
                                                <li class="mb-4">
                                                    <i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                                    {{ floor($price->duration / 365) > 0 ? floor($price->duration / 365) . ' ' . Str::plural('year', floor($price->duration / 365)) : '' }}
                                                    {{ floor(($price->duration % 365) / 30) > 0 ? floor(($price->duration % 365) / 30) . ' ' . Str::plural('month', floor(($price->duration % 365) / 30)) : '' }}
                                                </li>
                                            @endforeach

                                            {{-- Features --}}
                                            @foreach ($allFeatures as $feature)
                                                @php
                                                    $attachedFeature = $plan->features->firstWhere('id', $feature->id);
                                                @endphp
                                                <li class="mb-4">
                                                    @if ($attachedFeature)
                                                        <i class="fa fa-lg fa-check-circle text-warning mr-2"></i>
                                                        <strong>{{ $attachedFeature->pivot->feature_value }}</strong>
                                                        {{ $feature->name }}
                                                    @else
                                                        <i class="fa fa-lg fa-times-circle text-secondary mr-2"></i>
                                                        {{ $feature->name }}
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>

                                        <form action="{{ route('subscribe') }}" method="POST">
                                            @csrf
                                            @php
                                                $customer = Auth::guard('customer')->user();
                                                $latestSubscription = optional(
                                                    $customer->subscriptions()->latest('id')->first(),
                                                );
                                                $activePlanId = $latestSubscription->plan_id ?? null;
                                                $currentPlanPrice = $plan->prices->first(); // adjust if more than one price per plan
                                            @endphp

                                            <input type="hidden" name="plan_price_id" value="{{ $currentPlanPrice->id }}">

                                            <button type="submit"
                                                class="btn btn-block 
                                                {{ $plan->prices->where('price', '>', 0)->isNotEmpty() ? 'bg-success' : 'bg-warning' }} 
                                                text-white"
                                                {{ $plan->id === $activePlanId ? 'disabled' : '' }}>
                                                {{ $plan->id === $activePlanId ? 'Active' : ($plan->prices->where('price', '>', 0)->isNotEmpty() ? 'Buy Now' : 'Contact Us') }}
                                            </button>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
