<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
        // return view('auth.login');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function about()
    {
        return view('frontend.about');
    }

    // contact message store

    public function contactMessageStore(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        $contact = new Contact();
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        // send mail to admin
        // Mail::send('mail.contact', $data, function($message) use ($data){
        //     $message->from($data['email']);
        //     $message->to('kmushakil64@gmail.com');
        //     $message->subject($data['subject']);
        // });

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function stories()
    {
        return view('frontend.stories');
    }
}
