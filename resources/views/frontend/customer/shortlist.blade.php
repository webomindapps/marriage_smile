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
                    <div class="search">
                        <h3>Shortlist Profiles</h3>
                        @foreach ($shortlist as $list)
                            @php
                                $document = $list->customer?->documents?->first();
                            @endphp
                            <div class="position-relative">
                                <a onclick="return confirm('Are you sure you want to remove?')"
                                    href="{{ route('shortlist.remove', $list->id) }}" class="position-absolute top-0 end-0"
                                    style="z-index: 1;">
                                    <i class='bx bxs-trash p-2 m-1 mt-4 bg-danger rounded text-white'></i>
                                </a>
                                <div class="row box-j">
                                    <div class="col-lg-4 p0">
                                        <a>
                                            @if ($list->customer && $list->customer->documents->isNotEmpty())
                                                <img src="{{ asset('storage/' . $list->customer->documents->first()->image_url) }}"
                                                    class="img-fluid wid-testimoni">
                                            @else
                                                <img src="{{ asset('storage/default/image.jpg') }}"
                                                    class="img-fluid wid-testimoni">
                                            @endif
                                        </a>
                                    </div>

                                    <div class="col-lg-8 p0">
                                        <div class="test-main cls-for-all">
                                            <strong>{{ $list->customer->customer_id }}</strong>
                                            <p>Last seen on
                                                {{ $list->customer->last_login_time ? \Carbon\Carbon::parse($list->customer->last_login_time)->format('d-M-y') : 'N/A' }}
                                            </p>
                                            {{-- <a href="{{ route('customer.details', $list->id) }}"> --}}
                                            <h4 class="pro-hea">{{ $list->customer->name }}</h4>
                                            {{-- </a> --}}
                                            <p>{{ $list->customer->details->height }} .
                                                {{ $list->customer->details->locations }}/{{ $list->customer->details->permanent_locations }}
                                                .
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
                                                    </svg> <span>{{ $list->customer->details->designation }}</span>
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
                                                    </svg> <span> {{ $list->customer->details->annual_income }}</span>
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
                                                    </svg> <span>{{ $list->customer->details->qualification }}</span>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-book-heart">
                                                        <path
                                                            d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
                                                        <path
                                                            d="M16 8.2C16 7 15 6 13.8 6c-.8 0-1.4.3-1.8.9-.4-.6-1-.9-1.8-.9C9 6 8 7 8 8.2c0 .6.3 1.2.7 1.6h0C10 11.1 12 13 12 13s2-1.9 3.3-3.1h0c.4-.4.7-1 .7-1.7z" />
                                                    </svg> <span>{{ $list->customer->details->marritialstatus }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="pink-bg-list mt-2">
                                            <ul class="list-none col-li">
                                                @if ($duration->start_date < now() && $duration->end_date > now())
                                                    @php
                                                        $alreadySentOrReceived = \App\Models\FriendRequest::where(
                                                            function ($query) use ($list) {
                                                                $query
                                                                    ->where('sender_id', auth()->id())
                                                                    ->where('receiver_id', $list->customer->id);
                                                            },
                                                        )
                                                            ->orWhere(function ($query) use ($list) {
                                                                $query
                                                                    ->where('sender_id', $list->customer->id)
                                                                    ->where('receiver_id', auth()->id());
                                                            })
                                                            ->exists();
                                                    @endphp

                                                    <li>
                                                        @if (!$alreadySentOrReceived)
                                                            @if (
                                                                $subscription->chat_viewable === 'Unlimited' ||
                                                                    (is_numeric($subscription->chat_viewable) && $subscription->chat_viewable > 0))
                                                                <a
                                                                    href="{{ route('send.friend.request', $list->customer->id) }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                        height="17" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="lucide lucide-send">
                                                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                                                        <path d="M22 2 11 13" />
                                                                    </svg>
                                                                    <span>Send Request</span>
                                                                </a>
                                                            @else
                                                                <a href="javascript:void(0);"
                                                                    onclick="redirectToPricing();">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                        height="17" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="lucide lucide-send">
                                                                        <path d="m22 2-7 20-4-9-9-4Z" />
                                                                        <path d="M22 2 11 13" />
                                                                    </svg>
                                                                    <span>Send Request</span>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </li>
                                                @else
                                                    {{-- Subscription is either not started or expired --}}
                                                    <li>
                                                        <a href="javascript:void(0);" onclick="subscribe();">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                height="17" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-send">
                                                                <path d="m22 2-7 20-4-9-9-4Z" />
                                                                <path d="M22 2 11 13" />
                                                            </svg>
                                                            <span>Send Request</span>
                                                        </a>
                                                    </li>
                                                @endif


                                                @php
                                                    // Check if the current profile's customer_id is in the shortlisted IDs
                                                    $isShortlisted = in_array($list->customer->id, $shortlistedIds);
                                                @endphp

                                                <li>
                                                    <a href="{{ route('add-to-shortlist', $list->customer->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                            height="17" viewBox="0 0 24 24"
                                                            fill="{{ $isShortlisted ? '#ec4899' : 'white' }}"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="lucide lucide-star">
                                                            <polygon
                                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                                        </svg>
                                                        <span>Shortlist</span>
                                                    </a>
                                                </li>

                                                @php
                                                    $chatAllowed = \App\Models\FriendRequest::where(function (
                                                        $query,
                                                    ) use ($list) {
                                                        $query
                                                            ->where(function ($q) use ($list) {
                                                                $q->where('sender_id', auth()->id())->where(
                                                                    'receiver_id',
                                                                    $list->customer->id,
                                                                );
                                                            })
                                                            ->orWhere(function ($q) use ($list) {
                                                                $q->where('sender_id', $list->customer->id)->where(
                                                                    'receiver_id',
                                                                    auth()->id(),
                                                                );
                                                            });
                                                    })
                                                        ->where('status', 1)
                                                        ->exists();

                                                @endphp

                                                @if ($chatAllowed)
                                                    <li>
                                                        <a href="{{ route('chat', $list->customer->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                height="17" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-message-circle">
                                                                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                                                            </svg>
                                                            <span>Chat</span>
                                                        </a>
                                                    </li>
                                                @endif

                                                {{-- <li>
                                        @if (!in_array($list->id, $viewedProfileIds) && $subscription->profile_viewable <= 0)
                                            <a href="javascript:void(0);" onclick="showLimitReachedAlert();">
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
                                        @else
                                            <a href="{{ route('customer.details', $list->id) }}"
                                                @if (!in_array($list->id, $viewedProfileIds)) onclick="return confirmProfileView(this);" @endif>
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
                                        @endif

                                     

                                    </li> --}}
                                                {{-- {{ dd($duration->start_date, $duration->end_date, now()) }} --}}
                                                @if ($duration->start_date < now() && $duration->end_date > now())
                                                    <li>
                                                        @if (!in_array($list->id, $viewedProfileIds) && $subscription->profile_viewable <= 0)
                                                            {{-- Not viewed yet and profile view limit is over --}}
                                                            <a href="javascript:void(0);"
                                                                onclick="showLimitReachedAlert();">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                    height="17" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-circle-user-icon lucide-circle-user">
                                                                    <circle cx="12" cy="12" r="10" />
                                                                    <circle cx="12" cy="10" r="3" />
                                                                    <path
                                                                        d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                                                                </svg>
                                                                <span>View Profile</span>
                                                            </a>
                                                        @else
                                                            {{-- Already viewed or allowed to view --}}
                                                            <a href="{{ route('customer.details', $list->id) }}"
                                                                @if (!in_array($list->id, $viewedProfileIds)) onclick="return confirmProfileView(this);" @endif>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                    height="17" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="lucide lucide-circle-user-icon lucide-circle-user">
                                                                    <circle cx="12" cy="12" r="10" />
                                                                    <circle cx="12" cy="10" r="3" />
                                                                    <path
                                                                        d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                                                                </svg>
                                                                <span>View Profile</span>
                                                            </a>
                                                        @endif
                                                    </li>
                                                @else
                                                    {{-- Subscription is either not started or expired --}}
                                                    <li>
                                                        <a href="javascript:void(0);" onclick="subscribe();">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                height="17" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="lucide lucide-circle-user-icon lucide-circle-user">
                                                                <circle cx="12" cy="12" r="10" />
                                                                <circle cx="12" cy="10" r="3" />
                                                                <path
                                                                    d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                                                            </svg>
                                                            <span>View Profile</span>
                                                        </a>
                                                    </li>
                                                @endif


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $('#showProfilesButton').on('click', function() {
                $('#searchModal').modal('hide');
            });
        </script>

        <script>
            function confirmProfileView(el) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "If you view this page, the profile view count will be decreased by one.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, view profile',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = el.href;
                    }
                });
                return false;
            }

            function showLimitReachedAlert() {
                Swal.fire({
                    title: 'Profile View Limit Reached',
                    text: 'Your profile view count is completed. For better usage, please subscribe.',
                    icon: 'info',
                    confirmButtonText: 'Go to Subscription'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('pricing') }}";
                    }
                });
            }

            function subscribe() {
                Swal.fire({
                    title: 'Your Subscription Period as Ended ',
                    text: 'Please Subscribe,To view Profiles.',
                    icon: 'info',
                    confirmButtonText: 'Go to Subscription'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('pricing') }}";
                    }
                });
            }
            // function confirmProfileView(el) {
            //     alert('Viewing this profile will decrease your profile view count.');
            //     window.location.href = el.href;
            // }

            // function showLimitReachedAlert() {
            //     alert('Your profile view limit is reached. Please upgrade your plan.');
            //     window.location.href = "{{ route('pricing') }}";
            // }

            // function subscribe() {
            //     alert('Your subscription period has ended. Please subscribe to continue viewing profiles.');
            //     window.location.href = "{{ route('pricing') }}";
            // }

            function redirectToPricing() {
                alert('Please upgrade your plan to send friend requests.');
                window.location.href = "{{ route('pricing') }}";
            }
        </script>
    @endpush
@endsection
