@extends('frontend.layouts.applayout')
@section('main')
    @push('styles')
        <link href="{{ asset('frontend/assets/css/register.css') }}" rel="stylesheet">
    @endpush


    <section class="register-f">
        <div class="container">
            <h2 class="register-h">
                My Dashboard
            </h2>
            <div class="row big-y">
                <div class="col-md-8 bg-col">
                    <form class="row" action="{{ route('admin.customer.edit', $customer->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <h5 class="h5-find pd-1">About Myself —In Detail </h5>
                        <div class="col-6">
                            <select class="form-control" id="nationality" name="nationality">
                                <option value="" disabled>Select Nationality</option>
                                <option value="Indian" {{ $customer->nationality == 'Indian' ? 'selected' : '' }}>Indian
                                </option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-control" id="religion" name="religion">
                                <option value=""disabled selected>Select Religion</option>
                                <option value="Hindu" {{ $customer->details->religion == 'Hindu' ? 'selected' : '' }}>Hindu
                                </option>

                            </select>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $customer->name }}" placeholder="Name">
                        </div>
                        <div class="col-6">
                            <select class="form-control" id="qualification" name="qualification">
                                <option value="" disabled>Select Qualification</option>
                                @foreach (['BE', 'B Com', 'B Sc', 'B Tech', 'BBA', 'BCA', 'M Sc', 'M Tech', 'MBA', 'MCA', 'Diploma', 'ITI', 'Others', '10th', '12th'] as $qualification)
                                    <option value="{{ $qualification }}"
                                        {{ $customer->qualification == $qualification ? 'selected' : '' }}>
                                        {{ $qualification }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 position-relative">
                            <input type="text" name="dob" class="form-control" placeholder="DOB"
                                onfocus="(this.type='date')" onblur="if(this.value===''){this.type='text'}" id="dob"
                                autocomplete="off" value="{{ old('dob', $customer->details->dob) }}" required>
                        </div>

                        <div class="col-6">
                            <select class="form-control" id="mother_tongue" name="mother_tongue">
                                <option value="" disabled>Select Mother Tongue</option>
                                @foreach (['kannada', 'tamil', 'telugu', 'malayalam', 'hindi'] as $tongue)
                                    <option value="{{ $tongue }}"
                                        {{ $customer->details->mother_tongue == $tongue ? 'selected' : '' }}>
                                        {{ ucfirst($tongue) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <select id="caste" name="caste" class="form-select">
                                <option value="" disabled>Caste</option>
                                @foreach (['shetty', 'gowda', 'reddy', 'brahmin', 'Lingayits', 'Vyshas', 'Yadavas'] as $caste)
                                    <option value="{{ $caste }}"
                                        {{ $customer->details->caste == $caste ? 'selected' : '' }}>{{ ucfirst($caste) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <input type="text" class="form-control" id="gotra" name="gotra"
                                value="{{ $customer->details->gotra }}" placeholder="Gothra">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="sun_star" name="sun_star"
                                value="{{ $customer->details->sun_star }}" placeholder="Sunstar">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="birth_star" name="birth_star"
                                value="{{ $customer->details->birth_star }}" placeholder="Birth Star">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="annual_income" name="annual_income"
                                value="{{ $customer->details->annual_income }}" placeholder="Annual Income">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                value="{{ $customer->details->company_name }}" placeholder="Company Name">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="experience" name="experience"
                                value="{{ $customer->details->experience }}" placeholder="Working Experience">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="phone" name="phone" minlength="10"
                                maxlength="10" placeholder="Mobile No" value="{{ $customer->phone }}"
                                oninput="this.value = this.value.replace(/\D/g, '')">
                        </div>
                        <div class="col-6">
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $customer->email }}" placeholder="Email id ">
                        </div>



                        <div class="col-6">
                            <input type="text" class="form-control" id="aadhar_no" name="aadhar_no"
                                value="{{ $customer->details->aadhar_no }}" placeholder="AADHAR NO">
                        </div>
                        <div class="col-6">
                            <div id="hobbies-container">
                                <div class="hobby-row">
                                    <input type="text" class="form-control" name="hobbies" placeholder="Hobbies"
                                        value="{{ $customer->details->hobbies }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <input type="url" class="form-control" id="facebook_profile" name="facebook_profile"
                                placeholder="Facebook Profile / Insta Profile"
                                value="{{ $customer->details->facebook_profile }}">
                        </div>
                        <div class="col-12 bi-ftre">
                            <img src="{{ asset('storage/' . $customer->documents->first()->image_url) }}" height="100px"
                                width="100px">
                            <label> Update Horoscope </label><br />
                            <input type="file" id="image_path" name="image_path">
                        </div>

                        <div class="col-md-12">
                            <label for="marritialstatus">Marital Status</label>
                            <select id="marritialstatus" name="marritialstatus" class="form-select">
                                <option value="" disabled selected>Marital Status</option>
                                <option value="searching">Searching</option>
                                <option value="divorsed">Divorsed</option>
                            </select>
                        </div>

                        <div class="col-12 hidden" id="children-container">
                            <label for="children">Children Status</label>
                            <input type="number" class="form-control" id="children" name="no_of_children"
                                placeholder="Number of Children" value="{{ $customer->no_of_children }}">
                        </div>
                        <div class="col-md-12">
                            <select id="relationship_manager" name="req_rel_manager" class="form-select">
                                <option selected>Do you need relationship manager to search on behalf of you ?
                                </option>
                                <option>Yes </option>
                                <option> No</option>

                            </select>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" id="inputname" name="expectations" placeholder="Expectations? ">{{ $customer->expectations }}</textarea>

                        </div>
                        <h5 class="h5-find pd-2">My Family Details </h5>

                        <div class="col-6">
                            <input type="text" class="form-control" id="father_name" name="father_name"
                                placeholder="Father Name" value="{{ $customer->father_name }}">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="father_occupation" name="father_occupation"
                                placeholder="Father Occupation" value="{{ $customer->father_occupation }}">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="mother_name" name="mother_name"
                                placeholder="Mother Name" value="{{ $customer->mother_name }}">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="mother_occupation" name="mother_occupation"
                                placeholder="Mother Occupation" value="{{ $customer->mother_occupation }}">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="siblings" name="siblings"
                                placeholder="Siblings" value="{{ $customer->siblings }}">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="locations" name="locations"
                                placeholder="Locations" value="{{ $customer->locations }}">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" name="permanent_locations"
                                id="permanent_locations" placeholder="Permanent Location "
                                value="{{ $customer->permanent_locations }}">
                        </div>



                        <div class="col-md-12">
                            <select id="asset_value" name="asset_value" class="form-select">
                                <option selected>Asset Value </option>
                                <option value="5lakh-10lakh">5lakh - 10lakh</option>
                                <option value="10lakh-20lakh">10lakh - 20lakh</option>
                                <option value="will disclose later">Will Disclose Later</option>
                                @foreach (['5lakh-10lakh', '10lakh-20lakh', 'will disclose later'] as $asset_value)
                                    <option value="{{ $asset_value }}"
                                        {{ $customer->asset_value == $asset_value ? 'selected' : '' }}>
                                        {{ ucfirst($asset_value) }}</option>
                                @endforeach

                            </select>
                        </div>
                        <h5 class="h5-find pd-2">How I Want to Talk to My Matches</h5>
                        <div class="col-md-12">
                            <select id="preferreday" name="preferreday" class="form-select">
                                <option disabled selected>Preferred Day to Talk</option>
                                <option value="anyday">Any Day</option>
                                <option value="selectday">Select the day</option>
                                @foreach (['anyday', 'selectday'] as $preferreday)
                                    <option value="{{ $preferreday }}"
                                        {{ $customer->preferreday == $preferreday ? 'selected' : '' }}>
                                        {{ ucfirst($preferreday) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 hidden" id="timings-container">
                            <label for="timings">Timings</label>
                            <input type="datetime-local" name="timings" class="form-control" id="timings"
                                value="{{ $customer->timings }}">
                        </div>


                        <div class="col-12">
                            <input type="text" class="form-control" id="preferred_contact_no"
                                name="preferred_contact_no" minlength="10" maxlength="10"
                                placeholder="Prefered contact number to talk"
                                oninput="this.value = this.value.replace(/\D/g, '')"
                                value="{{ $customer->preferred_contact_no }}">
                        </div>
                        <div class="col-12">
                            <select class="form-control" id="contact_related_to" name="contact_related_to"
                                placeholder="Relation ">
                                {{-- <option value=""disable selected> Select Relation</option>
                                <option value="father">Father</option>
                                <option value="mother">Mother</option>
                                <option value="brother">Brother</option>
                                <option value="sister">Sister</option> --}}
                                @foreach (['father', 'mother', 'brother', 'sister'] as $related)
                                    <option value="{{ $related }}"
                                        {{ $customer->contact_related_to == $related ? 'selected' : '' }}>
                                        {{ ucfirst($related) }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-12">
                            <input type="checkbox" id="termscheck" value="Bike">
                            <label for="vehicle1"> Terms and conditions</label>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn bt-register">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        const maritalStatus = document.getElementById("marritialstatus");
        const childrenContainer = document.getElementById("children-container");
        const childrenInput = document.getElementById("children");

        maritalStatus.addEventListener("change", function() {
            if (maritalStatus.value === "divorsed") {
                childrenContainer.classList.remove("hidden");
                childrenInput.focus();
            } else {
                childrenContainer.classList.add("hidden");
                childrenInput.value = "";
            }
        });
    </script>

    <script>
        const inputState = document.getElementById("preferreday");
        const timingsContainer = document.getElementById("timings-container");
        const timingsInput = document.getElementById("timings");

        inputState.addEventListener("change", function() {
            if (inputState.value === "selectday") {
                timingsContainer.classList.remove("hidden");
                timingsInput.focus();
            } else {
                timingsContainer.classList.add("hidden");
                timingsInput.value = "";
            }
        });
    </script>
@endsection
