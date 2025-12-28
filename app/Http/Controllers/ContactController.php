<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail; // optional if you want to send email

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validate the form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Option 1: save to database (you can create a Contact model/table)
        // Contact::create($request->all());

        // Option 2: send email (configure mail in .env)
        /*
        Mail::to('info@yourdomain.com')->send(new ContactMail($request->all()));
        */

        // Redirect back with success message
        return back()->with('success', 'Your message has been sent successfully!');
    }
}
