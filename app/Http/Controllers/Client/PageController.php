<?php

namespace App\Http\Controllers\Client;

use App\Events\ContactNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use App\Mail\ThankYou;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function aboutUs()
    {
        return view('clients.about-us');
    }

    public function policies()
    {
        return view('clients.policies');
    }

    public function manual()
    {
        return view('clients.manual');
    }

    public function render($page) {
        $content = 'abc';

        return view('clients.dynamic-page', [
            'page'=> $page,
            'content'=> $content
        ]);
    } 




    public function contact()
    {
        $user = auth()->user();
        return view('clients.contact', compact('user'));
    }

    public function postContact(ContactRequest $request)
    {
        $request->all();

        $notification = Notification::create([
            'user_id' => $request->user()->id ?? null,
            'title' => $request->title,
            'message' => $request->message,
            'type' => 'contact',
        ]);

        event(new ContactNotification($notification));

        $contactData = [
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
            'title' => $request->title,
            'message' => $request->message,
        ];

        Mail::to('trantrunghieu422@gmail.com')->send(new Contact($contactData));

        Mail::to($contactData['email'])->send(new ThankYou($contactData));

        return back()->with('success', 'Gửi thông tin thành công');
    }
}
