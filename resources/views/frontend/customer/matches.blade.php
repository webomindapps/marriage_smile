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
                    <div class="bg-white-search row mb-3">
                        <div class="tab-class">
                            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="ex1-tab-1" data-bs-toggle="tab" href="#ex1-tabs-1"
                                        role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Search by
                                        Criteria</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="ex1-tab-2" data-bs-toggle="tab" href="#ex1-tabs-2"
                                        role="tab" aria-controls="ex1-tabs-2" aria-selected="false">
                                        Search by Profile ID
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="ex1-content">
                                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel"
                                    aria-labelledby="ex1-tab-1">
                                    <form id="searchCriteriaForm">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h4 class="heig-h4">Age</h4>
                                                <div class="byn">
                                                    <button type="button" class="btn btn-outline-secondary mb-3 age-filter"
                                                        data-value="20-25">20-25</button>
                                                    <button type="button" class="btn btn-outline-secondary mb-3 age-filter"
                                                        data-value="25-30">25-30</button>
                                                    <button type="button" class="btn btn-outline-secondary mb-3 age-filter"
                                                        data-value="Doesn't Matter">Doesn't Matter</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="hf">
                                        <h4 class="heig-h4">Marital Status</h4>
                                        <div class="byn">
                                            <button type="button" class="btn btn-outline-secondary mb-3 marital-status"
                                                data-value="Never Married">Never Married</button>
                                            <button type="button" class="btn btn-outline-secondary mb-3 marital-status"
                                                data-value="Doesn't Matter">Doesn't Matter</button>
                                        </div>
                                        <hr class="hf">
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn bt-register" id="searchProfiles">Search
                                                Profiles</button>
                                        </div>
                                    </form>
                                    <div id="searchResults" class="mt-3"></div>
                                </div>
                                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                    <form class="row ne-id-search" action="">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="profileId" name="profile_id"
                                                placeholder="Enter Profile ID">
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn bt-register">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row bo-filter">
                        <div class="col-md-10">
                            <h4 class="pro-hea"> Here's what we found!</h4>
                            <p class="last-showp">Showing 1-20 of 680 matches</p>
                        </div>
                        <div class="col-md-2">
                            <button id="filterIcon" class="rounded-3xl border border-solid border-neutral-300 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 24 24"
                                    fill="currentColor" class=" text-primary-500">
                                    <path
                                        d="M19,2H5A3,3,0,0,0,2,5V6.17a3,3,0,0,0,.25,1.2l0,.06a2.81,2.81,0,0,0,.59.86L9,14.41V21a1,1,0,0,0,.47.85A1,1,0,0,0,10,22a1,1,0,0,0,.45-.11l4-2A1,1,0,0,0,15,19V14.41l6.12-6.12a2.81,2.81,0,0,0,.59-.86l0-.06A3,3,0,0,0,22,6.17V5A3,3,0,0,0,19,2ZM13.29,13.29A1,1,0,0,0,13,14v4.38l-2,1V14a1,1,0,0,0-.29-.71L5.41,8H18.59ZM20,6H4V5A1,1,0,0,1,5,4H19a1,1,0,0,1,1,1Z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="customerDetailsContainer"></div>
                    @foreach ($profiledetails as $item)
                        <div class="row box-j ">

                            <div class="col-lg-4 p0">
                                <a href="{{ route('customer.details', $item->id) }}">
                                    @if ($item->customer && $item->customer->documents->isNotEmpty())
                                        <img src="{{ asset('storage/' . $item->customer->documents->first()->image_url) }}"
                                            class="img-fluid wid-testimoni">
                                    @else
                                        <img src="{{ asset('storage/default/image.jpg') }}"
                                            class="img-fluid wid-testimoni">
                                    @endif
                                </a>
                            </div>

                            <div class="col-lg-8 p0">
                                <div class="test-main cls-for-all">
                                    <p>
                                        Last seen on
                                        @if ($item->customer->last_login_time)
                                            {{ \Carbon\Carbon::parse($item->customer->last_login_time)->format('d-M-y') }}
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                    <a href="{{ route('customer.details', $item->id) }}">
                                        <h4 class="pro-hea">{{ $item->customer->name }}</h4>
                                    </a>
                                    <p>{{ $item->height }} . {{ $item->locations }}/{{ $item->permanent_locations }} .
                                        Others
                                    </p>
                                    <ul class="list-none">
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-briefcase-business">
                                                <path d="M12 12h.01" />
                                                <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                                                <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                                                <rect width="20" height="14" x="2" y="6" rx="2" />
                                            </svg> <span>Business - Beautician</span>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-indian-rupee">
                                                <path d="M6 3h12" />
                                                <path d="M6 8h12" />
                                                <path d="m6 13 8.5 8" />
                                                <path d="M6 13h3" />
                                                <path d="M9 13c6.667 0 6.667-10 0-10" />
                                            </svg> <span>Rs. {{ $item->annual_income }}</span>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-graduation-cap">
                                                <path
                                                    d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z" />
                                                <path d="M22 10v6" />
                                                <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5" />
                                            </svg> <span>{{ $item->qualification }}</span>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-book-heart">
                                                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
                                                <path
                                                    d="M16 8.2C16 7 15 6 13.8 6c-.8 0-1.4.3-1.8.9-.4-.6-1-.9-1.8-.9C9 6 8 7 8 8.2c0 .6.3 1.2.7 1.6h0C10 11.1 12 13 12 13s2-1.9 3.3-3.1h0c.4-.4.7-1 .7-1.7z" />
                                            </svg> <span>{{ $item->marritialstatus }}</span>
                                        </li>
                                    </ul>

                                </div>
                                <div class="pink-bg-list">
                                    <ul class="list-none col-li">
                                        <li>
                                            <a href="{{ route('send.friend.request', $item->id) }}">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-star">
                                                <polygon
                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                            </svg>
                                            <span>Shortlist</span>
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-message-circle">
                                                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                                            </svg>
                                            <span>Chat </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>
    <script>
        document.getElementById('showProfilesButton').addEventListener('click', function() {
            const profileId = document.getElementById('profileId').value;

            if (!profileId) {
                alert('Please enter a Profile ID');
                return;
            }

            fetch('/customer-details', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        customer_id: profileId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('customerDetailsContainer');
                    container.innerHTML = '';

                    if (data.success) {
                        const item = data.data;
                        const details = item.details;
                        container.innerHTML = `
                        <div class="row box-j">
                            <div class="col-lg-4 p0">
                                <img src="${details.image_url || '/path/to/default/image.jpg'}" class="img-fluid wid-testimoni">
                            </div>
                            <div class="col-lg-8 p0">
                                <div class="test-main cls-for-all">
                                    <p>Last seen on ${details.last_seen || 'N/A'}</p>
                                    <h4 class="pro-hea">${item.name}</h4>
                                    <p>${details.height || 'N/A'} . ${details.locations || 'N/A'}/${details.permanent_locations || 'N/A'} . Others</p>
                                    <ul class="list-none">
                                        <li><span>Business - ${item.business || 'N/A'}</span></li>
                                        <li><span>Rs. ${item.income || 'N/A'} p.a</span></li>
                                        <li><span>${item.qualification || 'N/A'}</span></li>
                                        <li><span>${item.marritialstatus || 'N/A'}</span></li>
                                    </ul>
                                </div>
                                <div class="pink-bg-list">
                                    <ul class="list-none col-li">
                                        <li><span>Send Request</span></li>
                                        <li><span>Shortlist</span></li>
                                        <li><span>Contact</span></li>
                                        <li><span>Chat</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>`;
                    } else {
                        container.innerHTML = `<p class="text-danger">${data.message}</p>`;
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    <script>
        document.getElementById('searchProfiles').addEventListener('click', function() {
            const selectedAge = document.querySelector('.age-filter.active')?.dataset.value || '';
            const selectedMaritalStatus = document.querySelector('.marital-status.active')?.dataset.value || '';

            fetch('/search-opposite-gender', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        age: selectedAge,
                        marital_status: selectedMaritalStatus
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    const results = data.map(profile => {
                        // Access customer details and profile details
                        const details = profile.details; // This will include gender, height, etc.

                        return `
                        <div class="row box-j">
                            <div class="col-lg-4 p0">
                                <img src="${details.image_url || '/path/to/default/image.jpg'}" class="img-fluid wid-testimoni">
                            </div>
                            <div class="col-lg-8 p0">
                                <div class="test-main cls-for-all">
                                    <p>Last seen on ${details.last_seen || 'N/A'}</p>
                                    <h4 class="pro-hea">${profile.name}</h4>
                                    <p>${details.height || 'N/A'} . ${details.locations || 'N/A'} / ${details.permanent_locations || 'N/A'} . Others</p>
                                    <ul class="list-none">
                                        <li><span>Business - ${details.business || 'N/A'}</span></li>
                                        <li><span>Rs. ${details.annual_income || 'N/A'} p.a</span></li>
                                        <li><span>${details.qualification || 'N/A'}</span></li>
                                        <li><span>${details.marital_status || 'N/A'}</span></li>
                                    </ul>
                                </div>
                                <div class="pink-bg-list">
                                    <ul class="list-none col-li">
                                        <li><span>Send Request</span></li>
                                        <li><span>Shortlist</span></li>
                                        <li><span>Contact</span></li>
                                        <li><span>Chat</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                    }).join('');

                    document.getElementById('searchResults').innerHTML = results || 'No profiles found.';
                });
        });
    </script>
@endsection
