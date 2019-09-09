<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ContactEmail;
use App\Mail\ContactMail;

class ContactFormController extends Controller
{
    public function submit(Request $request) {

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required',
        ]);

        // Store to email table

        $email = new ContactEmail();

        $email->name = $request->name;
        $email->email = $request->email;
        $email->subject = $request->subject;
        $email->message = $request->message;
        $email->save();

        // get last contact form submitted as last contact email row in table

        $latest_email = DB::table('contact_emails')->latest()->first();

        $latest_email_array = json_decode(json_encode($latest_email), true);

        //  Send mail to mailtrap inbox

        Mail::to('jeremybratcher@gmail.com')->send(new ContactMail($email));

        // Mail::send('emails.contact', $latest_email_array, function($message) use($latest_email_array) {
        //     $message->from($latest_email_array['email'] , $latest_email_array['name']);
        //     $message->to('jeremybratcher@gmail.com' , 'Jeremy');
        // });

        $json = response()->json(null, 200);

        return $json;
    }
}
