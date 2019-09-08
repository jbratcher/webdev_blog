<?php

namespace App\Http\Controllers;

use App\ContactEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
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

        // get last contact form submitted as last contact email row in table

        $latest_email = DB::table('contact_emails')->latest->first();

        //  Add mail functionality here.

        // try
        // {
        //     Mail::send($email);
        //     print("Message sent successfully");
        // }
        // catch(Exception $e)
        // {
        //     print("Message not sent");
        // }

        $json = response()->json(null, 200);

        print_r("email: " . print_r($latest_email) . PHP_EOL);

        print_r("json: " . print_r($json) . PHP_EOL);

        return $json;
    }
}
