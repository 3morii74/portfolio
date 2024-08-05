<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Exception;

class ContactController extends Controller
{
    public function __invoke(ContactRequest $request)
    {
        Log::info('Request Data:', $request->all());

        ini_set('max_execution_time', 1000);

        $name = $request->input('name');
        $email = $request->input('email');
        $body = $request->input('body');

        try {
            Log::info('Attempting to send email to: omerahmed200237@gmail.com');
            Log::info('Flash message set:', ['flash' => session('flash')]);

            Mail::to('omerahmed200237@gmail.com')->send(new ContactMail($name, $email, $body));
            Log::info('Email sent successfully.');
            return redirect()->back()->with([

                'type' => 'success',
                'message' => 'Your message has been sent successfully.'

            ]);
        } catch (Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
            return redirect()->back()->with([

                'type' => 'error',
                'message' => 'Failed to send email. Please try again later.'

            ])->withInput();
        }
    }
}
