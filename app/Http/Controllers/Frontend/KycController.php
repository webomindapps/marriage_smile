<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KycController extends Controller
{
    public function generateOtp(Request $request)
    {
        $request->validate([
            'aadhaar' => 'required|digits:12',
            'name' => 'required|string|max:255',
        ]);


        $response = Http::withHeaders([
            'app-id' => env('ZOOP_APP_ID'),
            'api-key' => env('ZOOP_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://test.zoop.one/in/identity/okyc/otp/request', [
            'mode' => 'sync',
            'data' => [
                'customer_aadhaar_number' => $request->aadhaar,
                'name_to_match' => $request->name,
                'consent' => 'Y',
                'consent_text' => 'I hereby declare my consent agreement for fetching my information via ZOOP API',
            ],
            'task_id' => Str::uuid()->toString(),
        ]);

        $responseData = $response->json();

        if (!empty($responseData['success']) && $responseData['success'] === true) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'request_id' => $responseData['request_id']
                ]
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => $responseData['response_message'] ?? 'Failed to generate OTP.',
            'details' => $responseData['metadata']['reason_message'] ?? null
        ], 400);
    }


    public function verifyOtp(Request $request)
{
    $response = Http::withHeaders([
        'app-id' => env('ZOOP_APP_ID'),
        'api-key' => env('ZOOP_API_KEY'),
        'Content-Type' => 'application/json',
    ])->post('https://test.zoop.one/in/identity/okyc/otp/verify', [
        'mode' => 'sync',
        'data' => [
            'request_id' => $request->request_id,
            'otp' => $request->otp,
            'consent' => 'Y',
            'consent_text' => 'I hereby declare my consent agreement for fetching my information via ZOOP API',
        ],
        'task_id' => Str::uuid()->toString(),
    ]);

    $responseData = $response->json();

    if (isset($responseData['success']) && $responseData['success'] === true) {
        return response()->json([
            'status' => 'success',
            'message' => $responseData['message'] ?? 'Aadhar verified successfully.',
            'data' => $responseData
        ]);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => $responseData['message'] ?? 'OTP verification failed.',
            'data' => $responseData
        ], 400);
    }
}

}
