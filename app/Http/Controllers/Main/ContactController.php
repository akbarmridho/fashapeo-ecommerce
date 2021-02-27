<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMailRequest;
use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('main.pages.contact');
    }

    public function contact(ContactMailRequest $request)
    {
        try {
            Mail::to(setting('contact.email', config('mail.from.address')))->send(new ContactUs($request->all()));
        } catch (\Exception $e) {
            session()->flash('error', 'Message cannot be sent');

            return route('contact');
        }

        session()->flash('status', 'Message sent');

        return route('contact');
    }
}
