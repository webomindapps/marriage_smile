<!DOCTYPE html>
<html>

<head>
    <div style="text-align: center; margin-bottom: 10px;">
        <img src="{{ public_path('frontend/assets/images/logo.png') }}" alt="Company Logo" style="max-height: 80px;">
    </div>
    <title>Profile details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 14px;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Profile Details</h2>
    <table>
        <thead>

        </thead>
        <tbody>
            <tr>

                <td>Name</td>
                <td>{{ $customers->customer->name }}</td>
            </tr>
            <tr>

                <td>Email</td>
                <td>{{ $customers->customer->email }}</td>
            </tr>
            <tr>

                <td>Phone</td>
                <td>{{ $customers->customer->phone }}</td>
            </tr>
            <tr>
                <td>Nationality</td>
                <td>{{ $customers->nationality }}</td>
            </tr>
            <tr>
                <td>Religion</td>
                <td>{{ $customers->religion ?? '-' }}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>{{ $customers->gender ?? '-' }}</td>
            </tr>
            <tr>

                <td>Height</td>
                <td>{{ $customers->height ?? '-' }}</td>
            </tr>
            <tr>

                <td>Colour</td>
                <td>{{ $customers->colour ?? '-' }}</td>
            </tr>
            <tr>

                <td>Qualification</td>
                <td>
                    {{ $customers->qualification == 'Others' ? $customers->other_qualification : $customers->qualification }}
                </td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td>{{ $customers->dob ?? '-' }}</td>
            </tr>
            <tr>
                <td>Age</td>
                <td>{{ $customers->age ?? '-' }}</td>
            </tr>
            <tr>
                <td>Mother Tongue</td>
                <td>{{ $customers->mother_tongue ?? '-' }}</td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td>{{ $customers->dob ?? '-' }}</td>
            </tr>
            <tr>
                <td>Caste</td>
                <td>{{ $customers->caste ?? '-' }}</td>
            </tr>
            <tr>
                <td>Gotra</td>
                <td>{{ $customers->gotra ?? '-' }}</td>
            </tr>
            <tr>
                <td>Sun Star</td>
                <td>{{ $customers->sun_star ?? '-' }}</td>
            </tr>
            <tr>
                <td>Birth Star</td>
                <td>{{ $customers->birth_star ?? '-' }}</td>
            </tr>
            <tr>
                <td>Annual Income</td>
                <td>{{ $customers->annual_income ?? '-' }}</td>
            </tr>
            <tr>
                <td>Company Name</td>
                <td>{{ $customers->company_name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Designation</td>
                <td>{{ $customers->designation ?? '-' }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $customers->customer->phone ?? '-' }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $customers->customer->email ?? '-' }}</td>
            </tr>
            <tr>
                <td>Hobbies</td>
                <td>{{ $customers->hobbies ?? '-' }}</td>
            </tr>
            <tr>
                <td>Facebook Profile Url</td>
                <td>{{ $customers->facebook_profile ?? '-' }}</td>
            </tr>
            <tr>
                <td> Marital Status</td>
                <td>{{ $customers->marritialstatus ?? '-' }}</td>
            </tr>
            <tr>
                <td> Number Of Children</td>
                <td>{{ $customers->no_of_children ?? '-' }}</td>
            </tr>
            <tr>
                <td> Expectations</td>
                <td>{{ $customers->expectations ?? '-' }}</td>
            </tr>
            <tr>
                <td>Father Name</td>
                <td>{{ $customers->father_name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Father's Occupation</td>
                <td>{{ $customers->father_occupation ?? '-' }}</td>
            </tr>
            <tr>
                <td>Mother Name</td>
                <td>{{ $customers->mother_name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Mother's Occupation</td>
                <td>{{ $customers->mother_occupation ?? '-' }}</td>
            </tr>
            <tr>
                <td>Siblings</td>
                <td>{{ $customers->siblings ?? '-' }}</td>
            </tr>
            <tr>
                <td>Present Address</td>
                <td>{{ $customers->locations ?? '-' }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
