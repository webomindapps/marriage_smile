@extends('frontend.layouts.applayout')
@section('main')
    @push('styles')
        <link href="{{ asset('frontend/assets/css/register.css') }}" rel="stylesheet">
    @endpush


    <section class="register-f">
        <div class="container">
            <h2 class="register-h">
                Let's Sign Up!
            </h2>
            <div class="row big-y">
                <div class="col-md-8 bg-col">


                    <form class="row" action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5 class="h5-find pd-1">About Myself —In Detail </h5>
                        <div class="col-6 position-relative required-field">
                            <select class="form-control" id="nationality" name="nationality" placeholder="nationality"
                                value="{{ old('nationlaity') }}" required>
                                <option value="" disabled selected>Select Nationality</option>
                                <option value="Indian">Indian</option>
                            </select>
                            @error('nationality')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <select class="form-control" id="religion" name="religion" placeholder="Religion"
                                value="{{ old('religion') }}" required>
                                <option value=""disabled selected>Select Religion</option>
                                <option value="hindu">Hindu</option>

                            </select>
                            @error('religion')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <select class="form-control" id="gender" name="gender" value="{{ old('gender') }}"
                                placeholder="Gender" required>
                                <option value=""disabled selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @error('gender')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="height" name="height"
                                value="{{ old('height') }}" placeholder="Height in ft" required>
                            @error('height')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="color" name="colour"
                                value="{{ old('colour') }}" placeholder="Colour" required>
                            @error('colour')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Name" required>
                            @error('name')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <select class="form-control" id="qualification" name="qualification"
                                value="{{ old('qualification') }}" placeholder="qualification" required>
                                <option value=""disabled selected>Select Qualification</option>
                                <option value="BE">BE</option>
                                <option value="B Com">B Com</option>
                                <option value="B Sc">B Sc</option>
                                <option value="B Tech">B Tech</option>
                                <option value="BBA">BBA</option>
                                <option value="BCA">BCA</option>
                                <option value="M Sc">M Sc</option>
                                <option value="M Tech">M Tech</option>
                                <option value="MBA">MBA</option>
                                <option value="MCA">MCA</option>
                                <option value="Diploma">Diploma</option>
                                <option value="ITI">ITI</option>
                                <option value="Others">Others</option>
                                <option value="10th">10th</option>
                                <option value="12th">12th</option>
                                @error('qualification')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group" id="other-qualification-field" style="display: none;">
                            <label for="other_qualification">Please Specify</label>
                            <input type="text" class="form-control" id="other_qualification" name="other_qualification"
                                placeholder="Enter your qualification">
                            @error('other_qualification')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6 position-relative">
                            <div class="form-floating mb-3">
                                <input type="text" name="dob" class="form-control" value="{{ old('dob') }}"
                                    placeholder="DOB" onfocus="(this.type='date')" onblur="(this.type='text')"
                                    id="dob" autocomplete="off" required>
                                <label for="dob">DOB</label>
                                @error('dob')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" value="{{ old('age') }}" placeholder="Age" name="age" id="age"
                                readonly  required>
                            @error('age')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-6">
                            <select class="form-control" id="mother_tongue" name="mother_tongue"
                            value="{{ old('mother_tongue') }}"  placeholder="Mother Tongue"  required>
                                <option value="" disabled selected>Select Mother Tongue</option>
                                <option value="kannada">Kannada</option>
                                <option value="tamil">Tamil</option>
                                <option value="telugu">Telugu</option>
                                <option value="malayalam">Malayalam</option>
                                <option value="hindi">Hindi</option>
                                <option value="others">Others</option>
                            </select>
                            @error('mother_tongue')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group" id="other-mothertongue-field" style="display: none;">
                            <label for="other_mothertongue">Please Specify</label>
                            <input type="text" class="form-control" id="other_mothertongue" name="other_mothertongue"
                                placeholder="Enter your Mother Tongue">
                            @error('other_mothertongue')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <input type="text" class="form-control" value="{{ old('caste') }}"  placeholder="caste" name="caste"
                                id="caste"  required>
                            @error('caste')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="gotra" name="gotra"
                            value="{{ old('gotra') }}"  placeholder="Gothra"  required>
                            @error('gotra')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="sun_star" name="sun_star"
                                value="{{ old('sun_star') }}" placeholder="Sunstar">
                            @error('sun_star')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="birth_star" name="birth_star"
                                value="{{ old('birth_star') }}" placeholder="Birth Star">
                            @error('birth_star')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <select name="annual_income" class="form-control" id="annual_income"
                                placeholder="annual_income" value="{{ old('annual_income') }}" required>
                                <option value=""disable selected>Select Annual Income</option>
                                <option value="1-10 lakh">1-10 Lakh</option>
                                <option value="11-20 lakh"> 10 -20 Lakh</option>
                                <option value="21-30 lakh">21-30 Lakh</option>
                                <option value="31-40 lakh">31-40 Lakh</option>
                                <option value="41-50 lakh">41-50 Lakh</option>
                                <option value="51-60 lakh">51-60 Lakh</option>
                                <option value="61-70 lakh">61-70 Lakh</option>
                            </select>
                            @error('annual_income')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                placeholder="Company Name" value="{{ old('company_name') }}" required>
                            @error('company_name')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="experience" name="experience"
                                placeholder="Work Experience" value="{{ old('experience') }}" required>
                            @error('experience')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <span class="input-group-text" id="country-code">+91</span>
                                <input type="text" class="form-control" id="phone" name="phone" minlength="10"
                                    maxlength="10" placeholder="Mobile No"
                                    oninput="this.value = this.value.replace(/\D/g, '')" value="{{ old('phone') }}"
                                    required>
                            </div>
                            @error('phone')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email id " value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6">
                            <input type="text" class="form-control" id="aadhar_no" name="aadhar_no"
                                placeholder="AADHAR NO " value="{{ old('aadhar_no') }}">
                            @error('aadhar_no')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6 position-relative">
                            <input type="password" class="form-control input-password" id="password" name="password"
                                placeholder="Enter Password" required>
                            <span class="login-pass toggle-password">
                                <i class="bx bx-hide"></i>
                            </span>
                            @error('password')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6 position-relative">
                            <input type="password" class="form-control input-password" id="conf_password"
                                name="conf_password" placeholder="Enter Confirm Password" required>
                            <span class="login-pass toggle-password">
                                <i class="bx bx-hide"></i>
                            </span>
                            @error('conf_password')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-6">
                            <div id="hobbies-container">
                                <div class="hobby-row">
                                    <textarea class="form-control" name="hobbies" placeholder="Hobbies" required></textarea>
                                </div>
                            </div>
                            @error('hobbies')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="url" class="form-control" id="facebook_profile" name="facebook_profile"
                                placeholder="Facebook Profile / Insta Profile">
                            @error('facebook_profile')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 bi-ftre">
                            <label>Horoscope</label><br />
                            <input type="file" id="image_path" name="image_path" required>
                        </div>

                        <div class="col-12 bi-ftre">
                            <label>Upload Profile</label><br />
                            <input type="file" class="image-file" name="image_url[]" id="image_url" multiple accept="image/*">
                            <div id="image-preview-container" class="d-flex mt-3"></div>
                        </div>

                        <div class="col-md-12">
                            <label for="marritialstatus">Marital Status</label>
                            <select id="marritialstatus" name="marritialstatus" class="form-select" required>
                                <option value="" disabled selected>Marital Status</option>
                                <option value="unmarried">Un Married</option>
                                <option value="divorsed">Divorsed</option>
                                @error('marritialstatus')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                        <div class="col-md-12 mt-3" id="children-container" style="display: none;">
                            <label for="numberOfChildren">Number of Children</label>
                            <input type="number" id="numberOfChildren" class="form-control"
                                placeholder="Enter number of children" min="1">
                        </div>

                        <div class="col-md-12 mt-3" id="children-details-container" style="display: none;">
                        </div>
                        <div class="col-md-12">
                            <select id="relationship_manager" name="req_rel_manager" class="form-select" required>
                                <option selected>Do you need relationship manager to search on behalf of you ?
                                </option>
                                <option>Yes </option>
                                <option> No</option>
                                @error('req_rel_manager')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror

                            </select>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" id="inputname" name="expectations" placeholder="Expectations? " required></textarea>
                            @error('expectations')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <h5 class="h5-find pd-2">My Family Details </h5>

                        <div class="col-6">
                            <input type="text" class="form-control" id="father_name" name="father_name"
                                placeholder="Father Name" required>
                            @error('father_name')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="father_occupation" name="father_occupation"
                                placeholder="Father Occupation" required>
                            @error('father_occupation')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="mother_name" name="mother_name"
                                placeholder="Mother Name" required>
                            @error('mother_name')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="mother_occupation" name="mother_occupation"
                                placeholder="Mother Occupation" required>
                            @error('mother_occupation')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="siblings" name="siblings"
                                placeholder="Number of Siblings" required>
                            @error('siblings')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="siblings-details-container" class="row mt-3"></div>

                        <div class="col-12">
                            <label for="locations">Present Address</label>
                            <input type="text" class="form-control" id="locations" name="locations"
                                placeholder="Present Address" required>
                            @error('locations')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12" id="present-house-status-container" style="display: none;">
                            <label for="present_house_status">House Status for Present Address</label>
                            <select id="present_house_status" name="present_house_status" class="form-select" required>
                                <option value="" disabled selected>Select House Status</option>
                                <option value="own">Own House</option>
                                <option value="rent">Rent House</option>
                            </select>
                            @error('present_house_status')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="permanent_locations">Permanent Address</label>
                            <input type="text" class="form-control" id="permanent_locations"
                                name="permanent_locations" placeholder="Permanent Address" required>
                            @error('permanent_locations')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12" id="permanent-house-status-container" style="display: none;">
                            <label for="permanent_house_status">House Status for Permanent Address</label>
                            <select id="permanent_house_status" name="permanent_house_status" class="form-select"
                                required>
                                <option value="" disabled selected>Select House Status</option>
                                <option value="own">Own House</option>
                                <option value="rent">Rent House</option>
                            </select>
                            @error('permanent_house_status')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <select id="asset_value" name="asset_value" class="form-select" required>
                                <option selected>Asset Value </option>
                                <option value="5lakh-10lakh">5lakh - 10lakh</option>
                                <option value="10lakh-20lakh">10lakh - 20lakh</option>
                                <option value="will disclose later">Will Disclose Later</option>
                                @error('asset_value')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror

                            </select>
                        </div>
                        <h5 class="h5-find pd-2">How I Want to Talk to My Matches</h5>
                        <div class="col-md-12">
                            <select id="preferreday" name="preferreday" class="form-select" required>
                                <option disabled selected>Preferred Day to Talk</option>
                                <option value="anyday">Any Day</option>
                                <option value="selectday">Select the day</option>
                                @error('preferreday')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror

                            </select>
                        </div>

                        <div class="col-12 hidden" id="timings-container">
                            <label for="timings">Timings</label>
                            <input type="datetime-local" name="timings" class="form-control" id="timings">
                        </div>


                        <div class="col-12">
                            <input type="text" class="form-control" id="preferred_contact_no"
                                name="preferred_contact_no" minlength="10" maxlength="10"
                                placeholder="Prefered contact number to talk"
                                oninput="this.value = this.value.replace(/\D/g, '')" required>
                            @error('preferred_contact_no')
                                <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="col-12">
                            <select class="form-control" id="contact_related_to" name="contact_related_to"
                                placeholder="Relation" required>
                                <option value=""disable selected> Select Relation</option>
                                <option value="father">Father</option>
                                <option value="mother">Mother</option>
                                <option value="brother">Brother</option>
                                <option value="sister">Sister</option>
                                @error('contact_related_to')
                                    <div class="text-danger ps-0 mb-2" style="font-size: 13px;">{{ $message }}</div>
                                @enderror
                            </select>

                        </div>
                        <div class="col-12">
                            <input type="checkbox" id="termscheck" value="Bike">
                            <label for="vehicle1"> Terms and conditions</label>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn bt-register">Register Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

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
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("select[required], input[required]").forEach(function(field) {
                const placeholder = field.getAttribute("placeholder");
                if (placeholder && !placeholder.includes("*")) {
                    field.setAttribute("placeholder", placeholder + " *");
                }
            });
        });
    </script>
    <script>
        document.getElementById('qualification').addEventListener('change', function() {
            const otherQualificationField = document.getElementById('other-qualification-field');
            if (this.value === 'Others') {
                otherQualificationField.style.display = 'block';
            } else {
                otherQualificationField.style.display = 'none';
            }
        });
    </script>

    <script>
        document.getElementById('mother_tongue').addEventListener('change', function() {
            const otherMotherTongueField = document.getElementById('other-mothertongue-field');
            if (this.value === 'others') {
                otherMotherTongueField.style.display = 'block';
            } else {
                otherMotherTongueField.style.display = 'none';
            }
        });
    </script>
    <script>
        document.getElementById('dob').addEventListener('change', function() {
            const dob = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const monthDiff = today.getMonth() - dob.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            document.getElementById('age').value = age > 0 ? age : 0;
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
@endsection
