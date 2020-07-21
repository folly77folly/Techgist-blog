<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;

class MailController extends Controller
{
    
    //
    public function contact(){
        return view('emails.contact');
    }

    public function send(Request $request){
        // dd($request->name);
        $rules =[
            'name'=>['required','min:5'],
            'email'=>['required'],
            'subject'=>['required', 'min:5', 'max:50'],
            'mail_message'=>['required',  'min:20', 'max:200'],
        ];
        $this->validate($request, $rules);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'mail_message' => $request->mail_message,
        ];
        Mail::send('emails.send', $data, function($message){
            $message->to('iamaqim@gmail.com', 'Aqim')->subject('mail received from tech gist');
        });
        $request->session()->flash('mail_sent_message', 'Message sent Successfully');
        return redirect('/');
    }
}
