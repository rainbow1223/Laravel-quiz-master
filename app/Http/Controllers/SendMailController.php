<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendMailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function send_mail(Request $request)
    {
        $details = [
            'data' => $request,
            'exam_date_time' => date("Y/m/d") . ' ' . date("h:i:sa"),
        ];

        \Mail::to($request->user_email)->send(new \App\Mail\QuizResultMail($details));

        $stuff_emails = explode(',', $request->stuff_emails);

        foreach ($stuff_emails as $stuff_email) {
            \Mail::to($stuff_email)->send(new \App\Mail\QuizResultMail($details));
        }

        dd("Email is Sent.");
    }
}
