<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preferred Day and Timeings</title>
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
                    <hr>
                    <h4> Customer name : {{ $customer->name }} <br />
                        Customer id: {{ $customer->customer_id }}<br />
                        Gender : {{ $customer->details->gender }}<br />
                        Phone No : {{ $customer->phone }}<br />
                        Email : {{$customer->email }}<br />
                        Day and Timmings : {{ $customer->details->timings }}
                    </h4>
                    <h5 class="">{{ $customer->name }} has requsted for the Preferred Day and Time To Meet the Bride/Groom.</h5>

                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>