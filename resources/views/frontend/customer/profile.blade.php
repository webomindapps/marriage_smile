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
                <div class="col-lg-7 text-end new-gp">
                    <!-- Hamburger Icon -->
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
                        ☰
                    </button>
                </div>

                <!-- Bootstrap Modal -->
                <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
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
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="ex1-tab-1" data-bs-toggle="tab"
                                                        href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1"
                                                        aria-selected="true">Search by Criteria</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="ex1-tab-2" data-bs-toggle="tab"
                                                        href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2"
                                                        aria-selected="false">Search by Profile ID</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="ex1-content">
                                                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel"
                                                    aria-labelledby="ex1-tab-1">
                                                    <!-- Search by Criteria Content -->
                                                    <div class="row ">
                                                        <div class="col-md-10">
                                                            <h4 class="heig-h4"> Age</h4>
                                                            <p class="heigh-p">24 to 31 Years </p>
                                                        </div>
                                                    </div>
                                                    <hr class="hf">
                                                    <h4 class="heig-h4"> Marital Status</h4>
                                                    <div class="byn">
                                                        <button class="btn btn-outline-secondary mb-3"> Doesn't
                                                            Matter</button>
                                                        <button class="btn btn-outline-secondary mb-3"> Never
                                                            Married</button>
                                                        <button class="btn btn-outline-secondary mb-3"> Awaiting
                                                            Divorce</button>
                                                        <button class="btn btn-outline-secondary mb-3"> Divorced</button>
                                                        <button class="btn btn-outline-secondary mb-3"> Widowed</button>
                                                        <button class="btn btn-outline-secondary mb-3"> Annulled</button>
                                                        <button class="btn btn-outline-secondary mb-3"> Married</button>
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <button type="submit" class="btn bt-register">Show Me
                                                            Profiles</button>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel"
                                                    aria-labelledby="ex1-tab-2">
                                                    <form class="row ne-id-search">
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" id="profileId"
                                                                name="customer_id" placeholder="Enter Profile ID">
                                                        </div>
                                                    </form>
                                                    <div class="col-12 text-center">
                                                        <button type="button" class="btn bt-register"
                                                            id="showProfilesButton">Show Me
                                                            Profiles</button>
                                                    </div>
                                                    <div id="customerDetailsContainer" class="mt-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-2">
                    <img src="{{ asset('frontend/assets/images/advertise.jpg') }}" class="img-fluid clas-to1">
                    <img src="{{ asset('frontend/assets/images/advert2.jpg') }}" class="img-fluid clas-to1">
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
                        container.innerHTML = `
                        <div class="row box-j">
                            <div class="col-lg-4 p0">
                                <img src="${item.image_url || '/path/to/default/image.jpg'}" class="img-fluid wid-testimoni">
                            </div>
                            <div class="col-lg-8 p0">
                                <div class="test-main cls-for-all">
                                    <p>Last seen on ${item.last_seen || 'N/A'}</p>
                                    <h4 class="pro-hea">${item.name}</h4>
                                    <p>5ft 1in . ${item.locations || 'N/A'}/${item.permanent_locations || 'N/A'} . Others</p>
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
@endsection
