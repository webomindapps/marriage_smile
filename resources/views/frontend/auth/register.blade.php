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
                            <select class="form-control" id="nationality" name="nationality" placeholder="nationality" required>
                                <option value="" disabled selected>Select Nationality</option>
                                <option value="Indian">Indian</option>
                            </select>
                        </div>
                        
                        <div class="col-6">
                            <select class="form-control" id="religion" name="religion" placeholder="Religion" required>
                                <option value=""disabled selected>Select Religion</option>
                                <option value="hindu">Hindu</option>

                            </select>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        </div>
                        <div class="col-6">
                            <select class="form-control" id="qualification" name="qualification" placeholder="qualification"
                                required>
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
                            </select>
                        </div>
                        <div class="col-6 position-relative">
                            <div class="form-floating mb-3">
                                <input type="text" name="dob" class="form-control" placeholder="DOB"
                                    onfocus="(this.type='date')" onblur="(this.type='text')" id="dob"
                                    autocomplete="off" required>
                                <label for="dob">DOB</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <select class="form-control" id="mother_tongue" name="mother_tongue" placeholder="Mother Tongue"
                                required>
                                <option value=""disabled selected>Select Mother Tongue</option>
                                <option value="kannada">Kannada</option>
                                <option value="tamil">Tamil</option>
                                <option value="telugu">Telugu</option>
                                <option value="malayalam">Malayalam</option>
                                <option value="hindi">Hindi</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <select id="inputState" class="form-select" name="caste" id="caste" required>
                                <option value="" disabled selected>Caste </option>
                                <option value="shetty">Shetty </option>
                                <option value="gowda"> Gowdas</option>
                                <option value="reddy">Reddy</option>
                                <option value="brahmin">Brahmin</option>
                                <option value="Lingayits">Lingayat</option>
                                <option value="Vyshas">Vyshas</option>
                                <option value="Yadavas">Yadavas</option>
                            </select>
                        </div>

                        <div class="col-6">
                            <input type="text" class="form-control" id="sub_caste" name="sub_caste"
                                placeholder="Sub Caste " required>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="gotra" name="gotra" placeholder="Gothra"
                                required>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="sun_star" name="sun_star"
                                placeholder="Sunstar" required>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="birth_star" name="birth_star"
                                placeholder="Birth Star" required>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="annual_income" name="annual_income"
                                placeholder="Annual Income" required>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                placeholder="Company Name" required>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="experience" name="experience"
                                placeholder="Working Experience" required>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="phone" name="phone" minlength="10"
                                maxlength="10" placeholder="Mobile No"
                                oninput="this.value = this.value.replace(/\D/g, '')" required>
                        </div>
                        <div class="col-6">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email id " required>
                        </div>
                        <div class="col-6 position-relative">
                            <input type="password" class="form-control input-password" id="password" name="password"
                                placeholder="Enter Password" required>
                            <span class="login-pass toggle-password">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>

                        <div class="col-6 position-relative">
                            <input type="password" class="form-control input-password" id="conf_password"
                                name="conf_password" placeholder="Enter Confirm Password" required>
                            <span class="login-pass toggle-password">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>


                        <div class="col-6">
                            <input type="text" class="form-control" id="aadhar_no" name="aadhar_no"
                                placeholder="AADHAR NO">
                        </div>
                        <div class="col-8">
                            <div id="hobbies-container">
                                <div class="hobby-row">
                                    <input type="text" class="form-control" name="hobbies[]" placeholder="Hobbies"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="button" id="add-hobby-btn" class="btn">Add Hobby</button>
                        </div>
                        <div class="col-12">
                            <input type="url" class="form-control" id="facebook_profile" name="facebook_profile"
                                placeholder="Facebook Profile / Insta Profile" required>
                        </div>
                        <div class="col-12 bi-ftre">
                            <label>Horoscope</label><br />
                            <input type="file" id="image_path" name="image_path" required>
                        </div>

                        <div class="col-md-12">
                            <label for="marritialstatus">Marital Status</label>
                            <select id="marritialstatus" name="marritialstatus" class="form-select" required>
                                <option value="" disabled selected>Marital Status</option>
                                <option value="searching">Searching</option>
                                <option value="divorsed">Divorsed</option>
                            </select>
                        </div>

                        <div class="col-12 hidden" id="children-container">
                            <label for="children">Children Status</label>
                            <input type="number" class="form-control" id="children" name="no_of_children"
                                placeholder="Number of Children">
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
                            <textarea class="form-control" id="inputname" name="expectations" placeholder="Expectations? "></textarea>

                        </div>
                        <h5 class="h5-find pd-2">My Family Details </h5>

                        <div class="col-6">
                            <input type="text" class="form-control" id="father_name" name="father_name"
                                placeholder="Father Name">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="father_occupation" name="father_occupation"
                                placeholder="Father Occupation">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="mother_name" name="mother_name"
                                placeholder="Mother Name">
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" id="mother_occupation" name="mother_occupation"
                                placeholder="Mother Occupation">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="siblings" name="siblings"
                                placeholder="Siblings">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" id="locations" name="locations"
                                placeholder="Locations">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" name="permanent_locations"
                                id="permanent_locations" placeholder="Permanent Location ">
                        </div>


                        <div class="col-md-12">
                            <select id="house_status" name="house_status" class="form-select">
                                <option selected>House Status </option>
                                <option>Own House</option>
                                <option>Rent House</option>
                                <option>Apartment</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <select id="asset_value" name="asset_value" class="form-select">
                                <option selected>Asset Value </option>
                                <option value="5lakh-10lakh">5lakh - 10lakh</option>
                                <option value="10lakh-20lakh">10lakh - 20lakh</option>
                                <option value="will disclose later">Will Disclose Later</option>


                            </select>
                        </div>
                        <h5 class="h5-find pd-2">How I Want to Talk to My Matches</h5>
                        <div class="col-md-12">
                            <select id="preferreday" name="preferreday" class="form-select">
                                <option disabled selected>Preferred Day to Talk</option>
                                <option value="anyday">Any Day</option>
                                <option value="selectday">Select the day</option>
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
                                oninput="this.value = this.value.replace(/\D/g, '')">
                        </div>
                        <div class="col-12">
                            <select class="form-control" id="contact_related_to" name="contact_related_to"
                                placeholder="Relation ">
                                <option value=""disable selected> Select Relation</option>
                                <option value="father">Father</option>
                                <option value="mother">Mother</option>
                                <option value="brother">Brother</option>
                                <option value="sister">Sister</option>
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
        const container = document.getElementById("hobbies-container");
        const addButton = document.getElementById("add-hobby-btn");
        let hobbyCount = 1;
        const maxRows = 3;
        addButton.addEventListener("click", function() {
            if (hobbyCount < maxRows) {
                hobbyCount++;
                const newRow = document.createElement("div");
                newRow.classList.add("hobby-row");
                newRow.innerHTML = `
                    <input type="text" class="form-control" name="hobbies[]" placeholder="Hobbies">
                `;
                container.appendChild(newRow);
            }

            if (hobbyCount >= maxRows) {
                addButton.disabled = true;
            }
        });
    </script>
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
