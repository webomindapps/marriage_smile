<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enquiry Mail</title>
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
                                    <img style="width: 100%;"
                                        src="{{ public_path('frontend/assets/images/logo.png') }}"width="120"
                                        height="113" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <h1>New Enquiry Received</h1>
                <p><strong>Name:</strong> {{ $enquiry->name }}</p>
                <p><strong>Email:</strong> {{ $enquiry->email }}</p>
                <p><strong>Phone:</strong> {{ $enquiry->phone }}</p>
                <p><strong>Message:</strong> {{ $enquiry->message }}</p>
            </tr>
        </tbody>
    </table>
</body>

</html>
