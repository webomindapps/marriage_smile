<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enquiry;
use App\Mail\EnquiryMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    public function index()
    {

        return view('frontend.pages.enquiry');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'message' => 'required|string|max:1000',
        ]);

        $enquiry = Enquiry::create($validatedData);

        $adminEmails = ['sunil@webomindapps.com'];
        Mail::to($adminEmails)->send(new EnquiryMail($enquiry));

        return redirect()->back()->with('success', 'We will get back to you soon.');
    }
}
