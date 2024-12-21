<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Marriage Smiles</title>
</head>

<body>
    <table style="background-color: #ebebeb; font-family: Arial, Helvetica, sans-serif;" border="0" width="650"
        cellspacing="0" cellpadding="0" align="center">
        <tbody>
            <tr>
                <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="width: 25%; background: #ffffff; padding: 10px;">
                                    <img style="width: 100%;" src="{{ public_path('frontend/assets/images/logo.png') }}"
                                        width="120" height="113" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 15px 15px;" valign="top">
                    <h3> Account Registered Successfully </h3>
                    <hr>
                    <h4> Dear {{ $customer->name }} ,,<br />Your Account with Marriage Smiles Has Been Created
                        Sucessfully With customer id {{ $customer->customer_id }}
                        <h5 class="">Please confirm that you want to use this as Marriage Smiles account email
                            address. Once
                            verified, you will be able to login to the account.</h5>
                        <a href="{{ route('customer.email.verified') }}?email={{ $customer->email }}"
                            style="padding: 10px  15px; background:#2d3748;text-decoration:none;color:#ffffff; text-align:center;">
                            Verify Account
                        </a>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
