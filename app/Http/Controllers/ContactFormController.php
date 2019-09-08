<?php

namespace App\Http\Controllers;

use App\ContactEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

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

        //  Add mail functionality here.

        try
        {
            Mail::send($email);
            print("Message sent successfully");
        }
        catch(Exception $e)
        {
            print("Message not sent");
        }


        return response()->json(null, 200);
    }
}
