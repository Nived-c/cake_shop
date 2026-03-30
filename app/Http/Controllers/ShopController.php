<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function customized()
    {
        return view('shop.customized');
    }

    public function delivery()
    {
        return view('shop.delivery');
    }

    public function contact()
    {
        return view('shop.contact');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'required|string',
            'message' => 'required|string|min:10',
        ]);

        // TODO: Send email / save to DB
        // Mail::to('hello@cakeatelier.in')->send(new ContactMail($request->all()));

        return redirect()->route('contact')
                         ->with('success', 'Thank you! Your message has been sent. We will get back to you within 24 hours.');
    }
}
