<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Subscription Confirmation</title>
</head>

<body>
    <table style="width:100%;">
        <tr>
            <td style="width: 25%; background: #ffffff; padding: 10px;">
                <img style="width: 100%;" src="{{ public_path('frontend/assets/images/logo.png') }}" width="120"
                    height="113" />
            </td>
        </tr>
    </table>
    <h2>Hello {{ $subscription->customer->name }},</h2>

    <p>Thank you for subscribing to the <strong>{{ $subscription->plan }}</strong> plan.</p>

    <h4>Subscription Details:</h4>
    <ul>
        <li><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y') }}</li>
        <li><strong>End Date:</strong> {{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y') }}</li>
        <li><strong>Duration:</strong> {{ $subscription->duration }} days</li>
        <li><strong>Price:</strong> ₹{{ $subscription->price }}</li>
        <li><strong>Status:</strong> {{ $subscription->status == '1' ? 'Active' : 'Inactive' }}</li>
    </ul>


    <p>Thanks,<br><strong>Marriage Smiles</strong></p>
</body>

</html>
