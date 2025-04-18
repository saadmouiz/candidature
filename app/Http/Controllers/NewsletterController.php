<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Mail\NewsletterWelcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Store a new newsletter subscription.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $newsletter = Newsletter::create($validated);

        // Send welcome email to the subscriber
        Mail::to($newsletter->email)->send(new NewsletterWelcome($newsletter->email));

        return back()->with('success', 'Merci pour votre inscription à notre newsletter!');
    }
} 