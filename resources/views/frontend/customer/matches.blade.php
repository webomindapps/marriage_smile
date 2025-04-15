@extends('frontend.layouts.applayout')
@section('main')
    @push('styles')
        <link href="{{ asset('frontend/assets/css/search.css') }}" rel="stylesheet">
        <style>
            .blur-image {
                filter: blur(8px);
                transition: filter 0.3s ease;
                cursor: pointer;
            }
        </style>
    @endpush
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-3">
                <x-Profilelayout />
            </div>
            <div class="col-lg-8 new-gp">
                <!-- Hamburger Icon -->
                <div class="row bo-filter">
                    <div class="col-md-10">
                        <h4 class="pro-hea"> Here's what we found!</h4>
                        <p class="last-showp">
                            Showing {{ $profiledetails->firstItem() }}–{{ $profiledetails->lastItem() }} of
                            {{ $profiledetails->total() }} matches
                        </p>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 24 24"
                                fill="currentColor" class=" text-primary-500">
                                <path
                                    d="M19,2H5A3,3,0,0,0,2,5V6.17a3,3,0,0,0,.25,1.2l0,.06a2.81,2.81,0,0,0,.59.86L9,14.41V21a1,1,0,0,0,.47.85A1,1,0,0,0,10,22a1,1,0,0,0,.45-.11l4-2A1,1,0,0,0,15,19V14.41l6.12-6.12a2.81,2.81,0,0,0,.59-.86l0-.06A3,3,0,0,0,22,6.17V5A3,3,0,0,0,19,2ZM13.29,13.29A1,1,0,0,0,13,14v4.38l-2,1V14a1,1,0,0,0-.29-.71L5.41,8H18.59ZM20,6H4V5A1,1,0,0,1,5,4H19a1,1,0,0,1,1,1Z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>


                <!-- Bootstrap Modal -->
                <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="profilemodal">
                            <div class="modal-header">
                                <h5 class="modal-title" id="searchModalLabel">Search Profiles</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-lg-12 new-gp">
                                    <div class="bg-white-search">
                                        <div class="tab-class">
                                            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab"
                                                        href="#criteriaTab">Search by Criteria</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#profileIdTab">Search by
                                                        Profile ID</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <!-- Search by Criteria -->
                                                <div class="tab-pane fade show active" id="criteriaTab">
                                                    <form id="filterForm" method="GET"
                                                        action="{{ route('customer.matches') }}">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h4 class="heig-h4"> Age</h4>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input type="number" name="age_from"
                                                                            class="form-control" placeholder="From"
                                                                            min="18">
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="number" name="age_to"
                                                                            class="form-control" placeholder="To">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <h4 class="heig-h4"> Marital Status</h4>
                                                        <div class="byn">
                                                            <select name="marital_status" class="form-control">
                                                                <option value=""disable selected>Doesn't Matter
                                                                </option>
                                                                <option value="awaiting Divorce">Awaiting Divorce</option>
                                                                <option value="divorsed">Divorced</option>
                                                                <option value="widowed">Widowed</option>
                                                                <option value="Aannulled">Annulled</option>
                                                                <option value="married">Married</option>
                                                                <option value="unmarried"> Un Married</option>

                                                            </select>

                                                        </div>
                                                        <div class="col-md-12">
                                                            <h4 class="heig-h4"> Height In ft</h4>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <input type="text" name="height"
                                                                        class="form-control" placeholder="Height in ft"
                                                                        min="2">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h4 class="heig-h4"> Qualification</h4>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <select class="form-control" id="qualification"
                                                                        name="qualification" required>
                                                                        <option value="" disabled
                                                                            {{ old('qualification') && old('qualification') !== 'Other' ? '' : 'selected' }}>
                                                                            Select Qualification
                                                                        </option>
                                                                        <option value="BE"
                                                                            {{ old('qualification') == 'BE' ? 'selected' : '' }}>
                                                                            BE</option>
                                                                        <option value="B Com"
                                                                            {{ old('qualification') == 'B Com' ? 'selected' : '' }}>
                                                                            B Com
                                                                        </option>
                                                                        <option value="B Sc"
                                                                            {{ old('qualification') == 'B Sc' ? 'selected' : '' }}>
                                                                            B Sc</option>
                                                                        <option value="B Tech"
                                                                            {{ old('qualification') == 'B Tech' ? 'selected' : '' }}>
                                                                            B Tech
                                                                        </option>
                                                                        <option value="BBA"
                                                                            {{ old('qualification') == 'BBA' ? 'selected' : '' }}>
                                                                            BBA</option>
                                                                        <option value="BCA"
                                                                            {{ old('qualification') == 'BCA' ? 'selected' : '' }}>
                                                                            BCA</option>
                                                                        <option value="M Sc"
                                                                            {{ old('qualification') == 'M Sc' ? 'selected' : '' }}>
                                                                            M Sc</option>
                                                                        <option value="M Tech"
                                                                            {{ old('qualification') == 'M Tech' ? 'selected' : '' }}>
                                                                            M Tech
                                                                        </option>
                                                                        <option value="MBA"
                                                                            {{ old('qualification') == 'MBA' ? 'selected' : '' }}>
                                                                            MBA</option>
                                                                        <option value="MCA"
                                                                            {{ old('qualification') == 'MCA' ? 'selected' : '' }}>
                                                                            MCA</option>
                                                                        <option value="Diploma"
                                                                            {{ old('qualification') == 'Diploma' ? 'selected' : '' }}>
                                                                            Diploma
                                                                        </option>
                                                                        <option value="ITI"
                                                                            {{ old('qualification') == 'ITI' ? 'selected' : '' }}>
                                                                            ITI</option>
                                                                        <option value="10th"
                                                                            {{ old('qualification') == '10th' ? 'selected' : '' }}>
                                                                            10th</option>
                                                                        <option value="12th"
                                                                            {{ old('qualification') == '12th' ? 'selected' : '' }}>
                                                                            12th</option>
                                                                        <option value="Other"
                                                                            {{ old('qualification') == 'Other' ? 'selected' : '' }}>
                                                                            Other
                                                                        </option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-center mt-3">
                                                            <button type="submit" class="btn bt-register">Show Me
                                                                Profiles</button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <!-- Search by Profile ID -->
                                                <div class="tab-pane fade" id="profileIdTab">
                                                    <form class="row ne-id-search" method="GET"
                                                        action="{{ route('customer.matches') }}"
                                                        id="profileIdSearchForm">
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" id="profileId"
                                                                name="customer_id" placeholder="Enter Profile ID">
                                                        </div>
                                                        <div class="col-12 text-center mt-3">
                                                            <button type="submit" class="btn bt-register"
                                                                id="showProfilesButton">Show Me Profiles</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($profiledetails as $item)
                    <div class="mb-2 counter-wrapper" data-id="{{ $item->id }}">
                        {{-- <strong>Total:</strong> <span class="total">{{ $item->photo_limit }}</span> |
                        <strong>Viewed:</strong>
                        <span class="viewed">{{ $item->photo_limit - $subscription->photo_viewable }}</span> | --}}
                        <strong>Photo Views Left:</strong>
                        <span class="left">{{ $subscription->photo_viewable }}</span> |
                        <strong>Profile Views Left:</strong>
                        <span > {{ $subscription->profile_viewable }}</span> |
                        <strong>Horoscope Views Left:</strong>
                        <span > {{ $subscription->hscop_viewable }}</span>
                    </div>

                    <div class="row box-j">
                        @if ($item->documents->isNotEmpty())
                            <div class="col-lg-4 p0">
                                <a href="javascript:void(0);" class="photo-view-btn" data-id="{{ $item->id }}"
                                    data-limit="{{ $item->photo_limit }}">
                                    <img src="{{ asset('storage/' . $item->documents->first()->image_url) }}"
                                        class="img-fluid wid-testimoni {{ $subscription->photo_viewable < 1 ? '' : 'blur-image' }}"
                                        id="photo-{{ $item->id }}" style="cursor: pointer;">
                                </a>
                                @if ($item->documents->count() > $item->photo_limit)
                                    <strong>
                                        You have reached your photo view limit.
                                        <a href="{{ route('pricing') }}">Upgrade your plan</a> to see more.
                                    </strong>
                                @endif
                            </div>
                        @endif






                        <div class="col-lg-8 p0">
                            <div class="test-main cls-for-all">
                                <strong>{{ $item->customer->customer_id }}</strong>
                                <p>Last seen on
                                    {{ $item->customer->last_login_time ? \Carbon\Carbon::parse($item->customer->last_login_time)->format('d-M-y') : 'N/A' }}
                                </p>
                                {{-- <a href="{{ route('customer.details', $item->id) }}"> --}}
                                <h4 class="pro-hea">{{ $item->customer->name }}</h4>
                                {{-- </a> --}}
                                <p>{{ $item->height }} . {{ $item->locations }}/{{ $item->permanent_locations }} . Others
                                </p>

                                <ul class="list-none">
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-briefcase-business">
                                            <path d="M12 12h.01" />
                                            <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                            <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                            <rect width="20" height="14" x="2" y="6" rx="2" />
                                        </svg> <span>{{ $item->designation }}</span>
                                    </li>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-indian-rupee">
                                            <path d="M6 3h12" />
                                            <path d="M6 8h12" />
                                            <path d="m6 13 8.5 8" />
                                            <path d="M6 13h3" />
                                            <path d="M9 13c6.667 0 6.667-10 0-10" />
                                        </svg> <span> {{ $item->annual_income }}</span>
                                    </li>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-graduation-cap">
                                            <path
                                                d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z" />
                                            <path d="M22 10v6" />
                                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5" />
                                        </svg> <span>{{ $item->qualification }}</span>
                                    </li>
                                    <li>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-book-heart">
                                            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
                                            <path
                                                d="M16 8.2C16 7 15 6 13.8 6c-.8 0-1.4.3-1.8.9-.4-.6-1-.9-1.8-.9C9 6 8 7 8 8.2c0 .6.3 1.2.7 1.6h0C10 11.1 12 13 12 13s2-1.9 3.3-3.1h0c.4-.4.7-1 .7-1.7z" />
                                        </svg> <span>{{ $item->marritialstatus }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="pink-bg-list mt-2">
                                <ul class="list-none col-li">
                                    <li>
                                        <a href="{{ route('send.friend.request', $item->customer->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-send">
                                                <path d="m22 2-7 20-4-9-9-4Z" />
                                                <path d="M22 2 11 13" />
                                            </svg>
                                            <span>Send Request</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('add-to-shortlist', $item->customer->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-star">
                                                <polygon
                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                            </svg>
                                            <span>Shortlist</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('chat',$item->customer->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-message-circle">
                                                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                                            </svg>
                                            <span>Chat</span>
                                        </a>
                                    </li>
                                    <li>

                                        <a href="{{ route('customer.details', $item->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-circle-user-icon lucide-circle-user">
                                                <circle cx="12" cy="12" r="10" />
                                                <circle cx="12" cy="10" r="3" />
                                                <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                                            </svg>
                                            <span>View Profile</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


            <!-- Pagination -->
            <div class="mt-3">
                {{ $profiledetails->links() }}
            </div>
        </div>
    </div>
    </div>


    <!-- JavaScript for Profile ID Search -->
    @push('scripts')
        <script>
            $('#showProfilesButton').on('click', function() {
                $('#searchModal').modal('hide');
            });
        </script>
        <script>
            $(document).ready(function() {
                console.log("jQuery is ready!");

                $('.photo-view-btn').on('click', function(e) {
                    e.preventDefault();

                    console.log("Photo button clicked!");

                    let photoId = $(this).data('id');
                    let photoLimit = $(this).data('limit');
                    let img = $(this).find('img');
                    let counterWrapper = $('.counter-wrapper[data-id="' + photoId + '"]');

                    $.ajax({
                        url: '{{ route('photo.view.ajax') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            photo_id: photoId,
                            photo_limit: photoLimit
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                img.removeClass('blur-image');
                                counterWrapper.find('.viewed').text(response.viewed);
                                counterWrapper.find('.left').text(response.left);
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Something went wrong.');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
