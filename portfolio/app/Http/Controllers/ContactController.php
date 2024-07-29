<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class ContactController extends Controller
{
    public function __invoke(ContactRequest $request)
    {
        // Debugging: Log the request data
        Log::info('Request Data:', $request->all());

        // Increase maximum execution time to 1000 seconds (if needed)
        ini_set('max_execution_time', 1000);

        // Retrieve validated data
        $name = $request->input('name');
        $email = $request->input('email');
        $body = $request->input('body');

        // Check if all fields are populated
        if (empty($name) || empty($email) || empty($body)) {
            return redirect()->back()->withErrors(['error' => 'All fields are required.']);
        }

        // Sending the email
        Mail::to('omerahmed200237@gmail.com')->send(new ContactMail($name, $email, $body));

        // Redirecting back with success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
