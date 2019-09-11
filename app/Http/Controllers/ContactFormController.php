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

        //  Send mail to mailtrap inbox

        Mail::to('jeremybratcher@gmail.com')->send(new ContactMail($email));

        $json = response()->json(null, 200);

        return $json;
    }
}
