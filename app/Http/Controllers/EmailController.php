<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserToUserEmail;
use App\Models\User;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
    
        $adminEmail = User::where('role', 'admin')->value('email'); // Get the admin user's email
    
        if ($this->isOnline()) {
            $mail_data = [
                'recipient' => $request->email, // Use the recipient's email
                'fromEmail' => $adminEmail, // Use the admin's email
                'fromName' => $request->name,
                'subject' => $request->subject,
                'body' => $request->message,
            ];
    
            \Mail::send('email-template', $mail_data, function ($message) use ($mail_data) {
                $message->to($mail_data['recipient']);
                $message->from($mail_data['fromEmail'], $mail_data['fromName']);
                $message->subject($mail_data['subject']);
            });
    
            return redirect()->back()->with('success', 'Email sent!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Check your internet connection');
        }
    }
    
    public function isOnline($site = "https://youtube.com/") {
        if (@fopen($site, "r")) {
            return true;
        } else {
            return false;
        }
    }
}
