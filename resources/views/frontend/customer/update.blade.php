@extends('frontend.layouts.applayout')
@section('main')
    @push('styles')
        <link href="{{ asset('frontend/assets/css/search.css') }}" rel="stylesheet">
        <style>
            .profile-edit {
                background: #fff;
                padding: 50px 50px 41px 50px;
                border-radius: 7px;
                border: 1px solid #cccccc59;
            }

            .bi-ftre {
                background: #fff;
                padding: 13px 10px;
                border-radius: 6px;
                border: 1px solid #00000024;
            }

            input::placeholder {
                font-size: 15px !important;
            }

            select.form-select {
                background-color: white;
                margin-top: 0px;
                margin-bottom: 14px;
                border: 1px solid #00000021 !important;
                padding-left: 12px !important;
                font-size: 15px;
                border-radius: 6px !important;
                color: #232323;
                background-size: 15px 34px !important;
            }
        </style>
    @endpush

    <section class="dash-pad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <x-profilelayout />
                    
                </div>
                <div class="col-lg-8 new-gp ">
                    <div class="profile-edit">
                        <form class="row g-3" id="registrationForm"
                            action="{{ route('admin.customer.edit', $customer->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <h5 class="h5-find pd-1"><i class="fas fa-user-circle"></i> Profile Details
                                <span>(Verified)</span>
                            </h5>
                            <div class="col-6">
                                <select class="form-control" id="nationality" name="nationality">
                                    <option value="" disabled>Select Nationality</option>
                                    <option value="Indian" {{ $customer->nationality == 'Indian' ? 'selected' : '' }}>Indian
                                    </option>
                                </select>
                                {{-- <div id="nationalityError" class="text-danger ps-0 mb-2 d-none" style="font-size: 13px;">
                                Please select your nationality.
                            </div> --}}
                                @error('nationality')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <select class="form-control" id="religion" name="religion">
                                    <option value=""disabled selected>Select Religion</option>
                                    <option value="hindu" {{ $customer->details->religion == 'hindu' ? 'selected' : '' }}>
                                        Hindu
                                    </option>
                                </select>
                                <div id="religionerror" class="text-danger ps-0 mb-2 d-none" style="font-size: 13px;">
                                    Please select your Religion.
                                </div>
                                @error('religion')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <select class="form-control" id="gender" name="gender">
                                    <option value="" disabled
                                        {{ empty($customer->details->gender) ? 'selected' : '' }}>
                                        Select
                                        Gender</option>
                                    <option value="male" {{ $customer->details->gender == 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female" {{ $customer->details->gender == 'female' ? 'selected' : '' }}>
                                        Female
                                    </option>
                                </select>
                                <div id="gendererror" class="text-danger ps-0 mb-2 d-none" style="font-size: 13px;">
                                    Please select Gender
                                </div>
                                @error('gender')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="height" name="height"
                                    value="{{ $customer->details->height ?? '' }}" placeholder="Height in ft" required>
                                @error('height')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="color" name="colour"
                                    value="{{ $customer->details->colour ?? '' }}" placeholder="Colour" required>
                                @error('colour')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $customer->name }}" placeholder="Name">
                                @error('name')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <select class="form-control" id="qualification" name="qualification" required>
                                    <option value="" disabled
                                        {{ empty($customer->details->qualification) ? 'selected' : '' }}>
                                        Select Qualification</option>
                                    <option value="BE"
                                        {{ $customer->details->qualification == 'BE' ? 'selected' : '' }}>
                                        BE
                                    </option>
                                    <option value="B Com"
                                        {{ $customer->details->qualification == 'B Com' ? 'selected' : '' }}>B Com
                                    </option>
                                    <option value="B Sc"
                                        {{ $customer->details->qualification == 'B Sc' ? 'selected' : '' }}>
                                        B Sc
                                    </option>
                                    <option value="B Tech"
                                        {{ $customer->details->qualification == 'B Tech' ? 'selected' : '' }}>B Tech
                                    </option>
                                    <option value="BBA"
                                        {{ $customer->details->qualification == 'BBA' ? 'selected' : '' }}>
                                        BBA
                                    </option>
                                    <option value="BCA"
                                        {{ $customer->details->qualification == 'BCA' ? 'selected' : '' }}>
                                        BCA
                                    </option>
                                    <option value="M Sc"
                                        {{ $customer->details->qualification == 'M Sc' ? 'selected' : '' }}>
                                        M Sc
                                    </option>
                                    <option value="M Tech"
                                        {{ $customer->details->qualification == 'M Tech' ? 'selected' : '' }}>M Tech
                                    </option>
                                    <option value="MBA"
                                        {{ $customer->details->qualification == 'MBA' ? 'selected' : '' }}>
                                        MBA
                                    </option>
                                    <option value="MCA"
                                        {{ $customer->details->qualification == 'MCA' ? 'selected' : '' }}>
                                        MCA
                                    </option>
                                    <option value="Diploma"
                                        {{ $customer->details->qualification == 'Diploma' ? 'selected' : '' }}>
                                        Diploma</option>
                                    <option value="ITI"
                                        {{ $customer->details->qualification == 'ITI' ? 'selected' : '' }}>
                                        ITI
                                    </option>
                                    <option value="Others"
                                        {{ $customer->details->qualification == 'Others' ? 'selected' : '' }}>Others
                                    </option>
                                    <option value="10th"
                                        {{ $customer->details->qualification == '10th' ? 'selected' : '' }}>
                                        10th
                                    </option>
                                    <option value="12th"
                                        {{ $customer->details->qualification == '12th' ? 'selected' : '' }}>
                                        12th
                                    </option>
                                </select>
                                <div id="qualificationerror" class="text-danger ps-0 mb-2 d-none"
                                    style="font-size: 13px;">
                                    Please select Qualification
                                </div>
                                @error('qualification')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group" id="other-qualification-field"
                                style="display: {{ $customer->details->qualification == 'Others' ? 'block' : 'none' }};">
                                <label for="other_qualification">Please Specify</label>
                                <input type="text" class="form-control" id="other_qualification"
                                    name="other_qualification"
                                    value="{{ $customer->details->other_qualification ?? '' }}"
                                    placeholder="Enter your qualification">
                                @error('other_qualification')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 position-relative">
                                <input type="text" name="dob" class="form-control"
                                    value="{{ $customer->details->dob ?? '' }}" placeholder="DOB"
                                    onfocus="(this.type='date')" onblur="if(this.value===''){this.type='text'}"
                                    id="dob" autocomplete="off" required>
                                @error('dob')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <input type="text" class="form-control" value="{{ $customer->details->age ?? '' }}"
                                    placeholder="Age" name="age" id="age" readonly required>
                                @error('age')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <select class="form-control" id="mother_tongue" name="mother_tongue" required>
                                    <option value="" disabled
                                        {{ $customer->details->mother_tongue ?? old('mother_tongue') ? '' : 'selected' }}>
                                        Select Mother Tongue
                                    </option>
                                    <option value="kannada"
                                        {{ ($customer->details->mother_tongue ?? old('mother_tongue')) == 'kannada' ? 'selected' : '' }}>
                                        Kannada
                                    </option>
                                    <option value="tamil"
                                        {{ ($customer->details->mother_tongue ?? old('mother_tongue')) == 'tamil' ? 'selected' : '' }}>
                                        Tamil
                                    </option>
                                    <option value="telugu"
                                        {{ ($customer->details->mother_tongue ?? old('mother_tongue')) == 'telugu' ? 'selected' : '' }}>
                                        Telugu
                                    </option>
                                    <option value="malayalam"
                                        {{ ($customer->details->mother_tongue ?? old('mother_tongue')) == 'malayalam' ? 'selected' : '' }}>
                                        Malayalam
                                    </option>
                                    <option value="hindi"
                                        {{ ($customer->details->mother_tongue ?? old('mother_tongue')) == 'hindi' ? 'selected' : '' }}>
                                        Hindi
                                    </option>
                                    <option value="Others"
                                        {{ ($customer->details->mother_tongue ?? old('mother_tongue')) == 'Others' ? 'selected' : '' }}>
                                        Others
                                    </option>
                                </select>
                                <div id="mother_tongue_error" class="text-danger ps-0 mb-2 d-none"
                                    style="font-size: 13px;">
                                    Please select your Mother Tongue
                                </div>
                                @error('mother_tongue')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group" id="other-mothertongue-field" style="display: none;">
                                <label for="other_mothertongue">Please Specify</label>
                                <input type="text" class="form-control" id="other_mothertongue"
                                    name="other_mothertongue"
                                    value="{{ $customer->details->other_mothertongue ?? old('other_mothertongue') }}"
                                    placeholder="Enter your Mother Tongue">
                                @error('other_mothertongue')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="caste" name="caste"
                                    value="{{ $customer->details->caste ?? old('caste') }}" placeholder="Caste" required>
                                @error('caste')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <input type="text" class="form-control" id="gotra" name="gotra"
                                    value="{{ $customer->details->gotra ?? old('gotra') }}" placeholder="Gotra" required>
                                @error('gotra')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <input type="text" class="form-control" id="sun_star" name="sun_star"
                                    value="{{ $customer->details->sun_star ?? old('sun_star') }}" placeholder="Sunstar">
                                @error('sun_star')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <input type="text" class="form-control" id="birth_star" name="birth_star"
                                    value="{{ $customer->details->birth_star ?? old('birth_star') }}"
                                    placeholder="Birth Star">
                                @error('birth_star')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                @php
                                    $incomeRanges = [];
                                    for ($start = 1; $start <= 70; $start++) {
                                        $end = $start + 1;
                                        $incomeRanges[] = "{$start}-{$end} Lakh";
                                    }
                                @endphp
                                <select class="form-control" id="annual_income" name="annual_income" required>
                                    <option value="" disabled
                                        {{ !$customer->details->annual_income ? 'selected' : '' }}>Select
                                        Annual Income</option>
                                    @foreach ($incomeRanges as $range)
                                        <option value="{{ $range }}"
                                            {{ $customer->details->annual_income == $range ? 'selected' : '' }}>
                                            {{ $range }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="annual_income_error" class="text-danger ps-0 mb-2 d-none"
                                    style="font-size: 13px;">
                                    Please select annual Income
                                </div>
                                @error('annual_income')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <input type="text" class="form-control" id="company_name" name="company_name"
                                    value="{{ $customer->details->company_name }}" placeholder="Company Name">
                                @error('company_name')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="experience" name="experience"
                                    value="{{ $customer->details->experience }}" placeholder="Working Experience"
                                    required>
                                @error('experience')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="country-code">+91</span>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        minlength="10" maxlength="10" placeholder="Mobile No"
                                        value="{{ $customer->phone ?? old('phone') }}"
                                        oninput="this.value = this.value.replace(/\D/g, '')" required>
                                </div>
                                @error('phone')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $customer->email }}" placeholder="Email id ">
                                @error('email')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <input type="text" class="form-control" id="aadhar_no" name="aadhar_no"
                                    value="{{ $customer->details->aadhar_no }}" placeholder="AADHAR NO" readonly>
                            </div>
                            <div class="col-6">
                                <div id="hobbies-container">
                                    <div class="hobby-row">
                                        <input type="text" class="form-control" name="hobbies" placeholder="Hobbies"
                                            value="{{ $customer->details->hobbies ?? old('hobbies') }}" required>
                                    </div>
                                </div>
                                @error('hobbies')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <input type="url" class="form-control" id="facebook_profile" name="facebook_profile"
                                    placeholder="Facebook Profile / Insta Profile"
                                    value="{{ $customer->details->facebook_profile }}">
                                @error('facebook_profile')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="bi-ftre">
                                    <label>Horoscope</label><br />
                                    <input type="file" id="image_path" name="image_path" {{-- If there's an image path, show the old one --}}
                                        @if ($customer->documents->isNotEmpty() && $customer->documents->first()->image_path) value="{{ asset('storage/' . $customer->documents->first()->image_path) }}" @endif>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="bi-ftre">
                                    <label>Upload Photo (Maximum 3 photos required)</label><br />
                                    <input type="file" class="image-file" name="image_url[]" id="image_url" multiple
                                        accept="image/*">
                                    <div id="image-preview-container" class="d-flex mt-3">
                                        {{-- Loop through each document and display images --}}
                                        @if ($customer->documents->isNotEmpty())
                                            @foreach ($customer->documents as $document)
                                                @if (isset($document->image_url))
                                                    <img src="{{ asset('storage/' . $document->image_url) }}"
                                                        class="img-thumbnail" width="100" height="100"
                                                        alt="Uploaded image">
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <select id="marritialstatus" name="marritialstatus" class="form-select" required>
                                    <option value="" disabled
                                        {{ old('marritialstatus', $customer->details->marritialstatus ?? '') ? '' : 'selected' }}>
                                        Marital Status
                                    </option>
                                    <option value="unmarried"
                                        {{ old('marritialstatus', $customer->details->marritialstatus ?? '') == 'unmarried' ? 'selected' : '' }}>
                                        Unmarried
                                    </option>
                                    <option value="divorsed"
                                        {{ old('marritialstatus', $customer->details->marritialstatus ?? '') == 'divorsed' ? 'selected' : '' }}>
                                        Divorced
                                    </option>
                                </select>
                                @error('marritialstatus')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                                <div id="marritialstatuserror" class="text-danger ps-0 mb-2 d-none"
                                    style="font-size: 13px;">
                                    Please select Marital Status
                                </div>
                            </div>

                            <div class="col-md-12 mt-3" id="children-container" style="display: none;">
                                <input type="number" id="numberOfChildren" name="no_of_children" class="form-control"
                                    placeholder="Enter number of children"
                                    value="{{ old('no_of_children', $customer->details->no_of_children ?? '') }}"
                                    min="1">
                            </div>
                            <div class="col-md-12 mt-3" id="children-details-container" style="display: none;">
                            </div>
                            <div class="col-md-12">
                                <select id="relationship_manager" name="req_rel_manager" class="form-select" required>
                                    <option value="" disabled
                                        {{ $customer->details->req_rel_manager ? '' : 'selected' }}>
                                        Do you need a relationship manager to search on behalf of you?
                                    </option>
                                    <option value="Yes"
                                        {{ $customer->details->req_rel_manager == 'Yes' ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="No"
                                        {{ $customer->details->req_rel_manager == 'No' ? 'selected' : '' }}>No
                                    </option>
                                </select>
                                @error('req_rel_manager')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <textarea class="form-control" id="inputname" name="expectations" placeholder="Expectations?">{{ $customer->details->expectations }}</textarea>
                                @error('expectations')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <h5 class="h5-find pd-2"><i class="fas fa-users"></i> My Family Details </h5>

                            <div class="col-6">
                                <input type="text" class="form-control" id="father_name" name="father_name"
                                    placeholder="Father Name" value="{{ $customer->details->father_name }}">
                                @error('father_name')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="father_occupation"
                                    name="father_occupation" placeholder="Father Occupation"
                                    value="{{ $customer->details->father_occupation }}">
                                @error('father_occupation')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="mother_name" name="mother_name"
                                    placeholder="Mother Name" value="{{ $customer->details->mother_name }}">
                                @error('mother_name')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="mother_occupation"
                                    name="mother_occupation" placeholder="Mother Occupation"
                                    value="{{ $customer->details->mother_occupation }}">
                                @error('mother_occupation')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" id="siblings" name="siblings"
                                    placeholder="Number of Siblings" value="{{ $customer->details->siblings }}" required>
                                @error('siblings')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="siblings-details-container" class="row mt-3">
                                {{-- @if ($customer->details->siblings_details)
                                @foreach ($customer->details->siblings_details as $index => $sibling)
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-6">
                                            <label>Sibling {{ $index + 1 }} Marital Status</label>
                                            <select class="form-select"
                                                name="sibling_{{ $index + 1 }}_marital_status">
                                                <option value="" disabled>Select Status</option>
                                                <option value="married"
                                                    {{ $sibling['marital_status'] == 'married' ? 'selected' : '' }}>
                                                    Married
                                                </option>
                                                <option value="unmarried"
                                                    {{ $sibling['marital_status'] == 'unmarried' ? 'selected' : '' }}>
                                                    Unmarried</option>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label>Sibling {{ $index + 1 }} Age Relation</label>
                                            <select class="form-select" name="sibling_{{ $index + 1 }}_age_relation">
                                                <option value="" disabled>Select Relation</option>
                                                <option value="younger"
                                                    {{ $sibling['age_relation'] == 'younger' ? 'selected' : '' }}>Younger
                                                </option>
                                                <option value="older"
                                                    {{ $sibling['age_relation'] == 'older' ? 'selected' : '' }}>Older
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            @endif --}}
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control" id="locations" name="locations"
                                    placeholder="Present Address"
                                    value="{{ $customer->details->locations ?? old('locations') }}" required>
                                @error('locations')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12" id="present-house-status-container"
                                style="{{ isset($customer->details->present_house_status) ? '' : 'display: none;' }}">
                                <select id="present_house_status" name="present_house_status" class="form-select"
                                    required>
                                    <option value="" disabled {{ old('present_house_status') ? '' : 'selected' }}>
                                        Select House Status
                                    </option>
                                    <option value="own"
                                        {{ ($customer->details->present_house_status ?? old('present_house_status')) == 'own' ? 'selected' : '' }}>
                                        Own
                                        House</option>
                                    <option value="rent"
                                        {{ ($customer->details->present_house_status ?? old('present_house_status')) == 'rent' ? 'selected' : '' }}>
                                        Rent
                                        House</option>
                                </select>
                                @error('present_house_status')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control" id="permanent_locations"
                                    name="permanent_locations" placeholder="Permanent Address"
                                    value="{{ $customer->details->permanent_locations ?? old('permanent_locations') }}"
                                    required>
                                @error('permanent_locations')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12" id="permanent-house-status-container"
                                style="{{ isset($customer->details->permanent_house_status) ? '' : 'display: none;' }}">
                                <label for="permanent_house_status">House Status for Permanent Address</label>
                                <select id="permanent_house_status" name="permanent_house_status" class="form-select"
                                    required>
                                    <option value="" disabled
                                        {{ old('permanent_house_status') ? '' : 'selected' }}>
                                        Select House Status
                                    </option>
                                    <option value="own"
                                        {{ ($customer->details->permanent_house_status ?? old('permanent_house_status')) == 'own' ? 'selected' : '' }}>
                                        Own
                                        House</option>
                                    <option value="rent"
                                        {{ ($customer->details->permanent_house_status ?? old('permanent_house_status')) == 'rent' ? 'selected' : '' }}>
                                        Rent
                                        House</option>
                                </select>
                                @error('permanent_house_status')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <select id="asset_value" name="asset_value" class="form-select" required>
                                    <option value="" disabled
                                        {{ isset($customer->details->asset_value) ? '' : 'selected' }}>
                                        Asset Value</option>
                                    <option value="5lakh - 10lakh"
                                        {{ isset($customer->details->asset_value) && $customer->details->asset_value == '5lakh - 10lakh' ? 'selected' : '' }}>
                                        5lakh - 10lakh</option>
                                    <option value="10lakh - 20lakh"
                                        {{ isset($customer->details->asset_value) && $customer->details->asset_value == '10lakh - 20lakh' ? 'selected' : '' }}>
                                        10lakh - 20lakh</option>
                                    <option value="Will Disclose Later"
                                        {{ isset($customer->details->asset_value) && $customer->details->asset_value == 'Will Disclose Later' ? 'selected' : '' }}>
                                        Will Disclose Later</option>
                                </select>
                                @error('asset_value')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                                <div id="asset_value_error" class="text-danger ps-0 mb-2 d-none"
                                    style="font-size: 13px;">
                                    Please select the Asset Value
                                </div>
                            </div>

                            <h5 class="h5-find pd-2"><i class="fas fa-comment-dots"></i> How I Want to Talk to My Matches
                            </h5>
                            <div class="col-md-12">
                                <select id="preferreday" name="preferreday" class="form-select" required>
                                    <option value="" disabled
                                        {{ isset($customer->details->preferreday) ? '' : 'selected' }}>
                                        Preferred Day to Talk</option>
                                    <option value="Any Day"
                                        {{ isset($customer->details->preferreday) && $customer->details->preferreday == 'Any Day' ? 'selected' : '' }}>
                                        Any Day</option>
                                    <option value="selectday"
                                        {{ isset($customer->details->preferreday) && $customer->details->preferreday == 'selectday' ? 'selected' : '' }}>
                                        Select the day</option>
                                </select>
                                @error('preferreday')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 {{ isset($customer->details->preferreday) && $customer->details->preferreday == 'selectday' ? '' : 'hidden' }}"
                                id="timings-container">
                                <label for="timings">Timings</label>
                                <input type="datetime-local" name="timings" class="form-control"
                                    value="{{ $customer->details->timings ?? old('timings') }}" id="timings">
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control" id="preferred_contact_no"
                                    name="preferred_contact_no" minlength="10" maxlength="10"
                                    placeholder="Preferred contact number to talk"
                                    oninput="this.value = this.value.replace(/\D/g, '')"
                                    value="{{ $customer->details->preferred_contact_no ?? old('preferred_contact_no') }}"
                                    required>
                                @error('preferred_contact_no')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <select class="form-control" id="contact_related_to" name="contact_related_to" required>
                                    <option value="" disabled
                                        {{ isset($customer->details->contact_related_to) ? '' : 'selected' }}>Relation
                                    </option>
                                    <option value="father"
                                        {{ isset($customer->details->contact_related_to) && $customer->details->contact_related_to == 'father' ? 'selected' : '' }}>
                                        Father</option>
                                    <option value="mother"
                                        {{ isset($customer->details->contact_related_to) && $customer->details->contact_related_to == 'mother' ? 'selected' : '' }}>
                                        Mother</option>
                                    <option value="brother"
                                        {{ isset($customer->details->contact_related_to) && $customer->details->contact_related_to == 'brother' ? 'selected' : '' }}>
                                        Brother</option>
                                    <option value="sister"
                                        {{ isset($customer->details->contact_related_to) && $customer->contact_related_to == 'sister' ? 'selected' : '' }}>
                                        Sister</option>
                                </select>
                                <div id="contact_related_to_error" class="text-danger ps-0 mb-2 d-none"
                                    style="font-size: 13px;">
                                    Please select Qualification
                                </div>
                                @error('contact_related_to')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn bt-register">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    <script>
        document.getElementById('qualification').addEventListener('change', function() {
            const otherQualificationField = document.getElementById('other-qualification-field');
            otherQualificationField.style.display = this.value === 'Others' ? 'block' : 'none';
        });
    </script>
    <script>
        document.getElementById('dob').addEventListener('change', function() {
            const dob = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();

            // Adjust age if the current date is before the birth date in the current year
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            document.getElementById('age').value = age > 0 ? age : '';
        });
    </script>
    <script>
        document.getElementById('mother_tongue').addEventListener('change', function() {
            const otherMotherTongueField = document.getElementById('other-mothertongue-field');
            if (this.value === 'Others') {
                otherMotherTongueField.style.display = 'block';
            } else {
                otherMotherTongueField.style.display = 'none';
            }
        });

        window.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('mother_tongue').value === 'Others') {
                document.getElementById('other-mothertongue-field').style.display = 'block';
            }
        });
    </script>
    <script>
        document.getElementById("image_url").addEventListener("change", function(event) {
            const previewContainer = document.getElementById("image-preview-container");
            previewContainer.innerHTML = "";
            const files = event.target.files;

            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageWrapper = document.createElement("div");
                    imageWrapper.style.marginRight = "10px";
                    imageWrapper.style.textAlign = "center";
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.alt = `Picture ${index + 1}`;
                    img.style.width = "100px";
                    img.style.height = "100px";
                    img.style.objectFit = "cover";
                    img.style.border = "1px solid #ccc";
                    img.style.borderRadius = "4px";

                    const label = document.createElement("p");
                    label.textContent = `Picture ${index + 1}`;
                    label.style.marginTop = "5px";
                    label.style.fontSize = "14px";

                    imageWrapper.appendChild(img);
                    imageWrapper.appendChild(label);

                    previewContainer.appendChild(imageWrapper);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
    <script>
        document.getElementById("marritialstatus").addEventListener("change", function() {
            const status = this.value;
            const childrenContainer = document.getElementById("children-container");
            const childrenDetailsContainer = document.getElementById("children-details-container");

            if (status === "divorsed") {
                childrenContainer.style.display = "block";
            } else {
                childrenContainer.style.display = "none";
                childrenDetailsContainer.style.display = "none";
                childrenDetailsContainer.innerHTML = "";
            }
        });

        document.getElementById("numberOfChildren").addEventListener("input", function() {
            const count = parseInt(this.value);
            const childrenDetailsContainer = document.getElementById("children-details-container");

            childrenDetailsContainer.innerHTML = "";

            if (!isNaN(count) && count > 0) {
                childrenDetailsContainer.style.display = "block";

                for (let i = 1; i <= count; i++) {
                    const childRow = document.createElement("div");
                    childRow.classList.add("row", "mb-3", "align-items-center");

                    const genderContainer = document.createElement("div");
                    genderContainer.classList.add("col-6");
                    const genderLabel = document.createElement("label");
                    genderLabel.textContent = `Child ${i} Gender`;
                    const genderSelect = document.createElement("select");
                    genderSelect.classList.add("form-select");
                    genderSelect.name = `child_${i}_gender`;
                    genderSelect.innerHTML = `
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    `;
                    genderContainer.appendChild(genderLabel);
                    genderContainer.appendChild(genderSelect);

                    const ageContainer = document.createElement("div");
                    ageContainer.classList.add("col-6");
                    const ageLabel = document.createElement("label");
                    ageLabel.textContent = `Child ${i} Age`;
                    const ageInput = document.createElement("input");
                    ageInput.type = "number";
                    ageInput.name = `child_${i}_age`;
                    ageInput.classList.add("form-control");
                    ageInput.placeholder = `Enter Child ${i} Age`;
                    ageInput.min = 0;
                    ageContainer.appendChild(ageLabel);
                    ageContainer.appendChild(ageInput);

                    childRow.appendChild(genderContainer);
                    childRow.appendChild(ageContainer);

                    childrenDetailsContainer.appendChild(childRow);
                }
            } else {
                childrenDetailsContainer.style.display = "none";
            }
        });
    </script>
    <script>
        document.getElementById("siblings").addEventListener("input", function() {
            const count = parseInt(this.value);
            const siblingsDetailsContainer = document.getElementById("siblings-details-container");

            siblingsDetailsContainer.innerHTML = "";

            if (!isNaN(count) && count > 0) {
                for (let i = 1; i <= count; i++) {
                    const siblingRow = document.createElement("div");
                    siblingRow.classList.add("row", "mb-3", "align-items-center");

                    const maritalStatusContainer = document.createElement("div");
                    maritalStatusContainer.classList.add("col-6");
                    const maritalStatusLabel = document.createElement("label");
                    maritalStatusLabel.textContent = `Sibling ${i} Marital Status`;
                    const maritalStatusSelect = document.createElement("select");
                    maritalStatusSelect.classList.add("form-select");
                    maritalStatusSelect.name = `sibling_${i}_marital_status`;
                    maritalStatusSelect.innerHTML = `
                        <option value="" disabled selected>Select Status</option>
                        <option value="married">Married</option>
                        <option value="unmarried">Unmarried</option>
                    `;
                    maritalStatusContainer.appendChild(maritalStatusLabel);
                    maritalStatusContainer.appendChild(maritalStatusSelect);

                    const ageRelationContainer = document.createElement("div");
                    ageRelationContainer.classList.add("col-6");
                    const ageRelationLabel = document.createElement("label");
                    ageRelationLabel.textContent = `Sibling ${i} Age Relation`;
                    const ageRelationSelect = document.createElement("select");
                    ageRelationSelect.classList.add("form-select");
                    ageRelationSelect.name = `sibling_${i}_age_relation`;
                    ageRelationSelect.innerHTML = `
                        <option value="" disabled selected>Select Relation</option>
                        <option value="younger">Younger</option>
                        <option value="older">Older</option>
                    `;
                    ageRelationContainer.appendChild(ageRelationLabel);
                    ageRelationContainer.appendChild(ageRelationSelect);

                    siblingRow.appendChild(maritalStatusContainer);
                    siblingRow.appendChild(ageRelationContainer);
                    siblingsDetailsContainer.appendChild(siblingRow);
                }
            }
        });
    </script>
    <script>
        document.getElementById("locations").addEventListener("input", function() {
            const presentAddress = this.value.trim();
            const presentStatusContainer = document.getElementById("present-house-status-container");

            if (presentAddress) {
                presentStatusContainer.style.display = "block";
            } else {
                presentStatusContainer.style.display = "none";
            }
        });

        document.getElementById("permanent_locations").addEventListener("input", function() {
            const permanentAddress = this.value.trim();
            const permanentStatusContainer = document.getElementById("permanent-house-status-container");

            if (permanentAddress) {
                permanentStatusContainer.style.display = "block";
            } else {
                permanentStatusContainer.style.display = "none";
            }
        });

        // Automatically show containers if values are already populated
        window.addEventListener("DOMContentLoaded", function() {
            const presentAddress = document.getElementById("locations").value.trim();
            const permanentAddress = document.getElementById("permanent_locations").value.trim();

            if (presentAddress) {
                document.getElementById("present-house-status-container").style.display = "block";
            }

            if (permanentAddress) {
                document.getElementById("permanent-house-status-container").style.display = "block";
            }
        });
        document.getElementById("asset_value").addEventListener("change", function() {
            const assetValueError = document.getElementById("asset_value_error");

            if (this.value) {
                assetValueError.classList.add("d-none");
            } else {
                assetValueError.classList.remove("d-none");
            }
        });
    </script>

@endsection
