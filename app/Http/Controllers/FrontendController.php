<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Contact;
use App\Models\Essay;
use App\Models\Master;
use App\Models\Poetry;
use App\Models\Publication;
use App\Models\Research;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index()
    {
        $books = Book::latest()->limit(16)->get();

        $poetries = Poetry::select('id','slug', 'description', 'name','feature_image','short_description')->orderby('id', 'DESC')->get();
        $metadata = Master::where('category', 'Home')->first();
        
        return view('frontend.index', compact('books','poetries','metadata'));
    }

    public function contact()
    {
        $metadata = Master::where('category', 'Contact')->first();
        return view('frontend.contact', compact('metadata'));
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
        $metadata = Master::where('category', 'Story')->first();
        return view('frontend.stories', compact('metadata'));
    }

    public function poetries()
    {
        $metadata = Master::where('category', 'Poetry')->first();
        return view('frontend.poetries', compact('metadata'));
    }

    public function essay()
    {
        $metadata = Master::where('category', 'Essay')->first();
        return view('frontend.essay', compact('metadata'));
    }

    public function showessay($slug)
    {
        $story = Essay::select('id', 'description', 'name','feature_image','short_description')->where('slug', $slug)->first();
        return view('frontend.essaydetails', compact('story'));
    }

    public function showStory($slug)
    {
        $story = Story::select('id', 'description', 'name','feature_image','short_description')->where('slug', $slug)->first();
        return view('frontend.essaydetails', compact('story'));
    }

    public function research()
    {
        $metadata = Master::where('category', 'Research')->first();
        return view('frontend.research', compact('metadata'));
    }

    public function book()
    {
        $data = Book::latest()->get();
        $metadata = Master::where('category', 'Book')->first();
        return view('frontend.book', compact('data','metadata'));
    }

    public function bookDetails($slug)
    {
        $data = Book::where('slug', $slug)->first();
        return view('frontend.bookDetails', compact('data'));
    }

    public function showResearch($slug)
    {
        $story = Research::select('id', 'description', 'name','feature_image','short_description')->where('slug', $slug)->first();
        return view('frontend.essaydetails', compact('story'));
    }


    public function showPoetries($slug)
    {
        $story = Poetry::select('id', 'description', 'name','feature_image','short_description')->where('slug', $slug)->first();
        return view('frontend.essaydetails', compact('story'));
    }


    public function publications()
    {
        $metadata = Master::where('category', 'Publication')->first();
        return view('frontend.publications', compact('metadata'));
    }

    public function showPublication($slug)
    {
        $data = Publication::select('id', 'description', 'name','feature_image','short_description')->where('slug', $slug)->first();
        return view('frontend.publicationDetails', compact('data'));
    }
}
