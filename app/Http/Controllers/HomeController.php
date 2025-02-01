<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home.index');
    }

    public function store(Request $request)
    {

        request()->validate([
            'name'  => 'required',
            'description'  => 'required',
            'email'  => 'required',
        ]);

        $SupportTicket  = new SupportTicket();
        $randomCode = Str::random(20);
        $email = $request->input('email');
        $SupportTicket->ref_no = $randomCode;
        $SupportTicket->customer_name = $request->input('name');
        $SupportTicket->problem_description = $request->input('description');
        $SupportTicket->email = $email;
        $SupportTicket->phone_number = $request->input('phone_number');
        $SupportTicket->status = "Pending";
        $SupportTicket->isView = false;

        $saved = $SupportTicket->save();
        if (!$saved) {
            App::abort(500, 'Error');
        }

        $details = [
            'title' => 'Your ticket has been created, Ref No: ' . $randomCode,
            'body' => 'You just created a ticket.',
            'status' => 'Pending'
        ];

        Mail::to($email)->send(new \App\Mail\ticketStatusMail($details));

        return Response()->json([
            "success" => true,
            "ref_no" => $randomCode
        ]);
    }

    public function searchByRef(Request $request)
    {
        $ref_no = $request->input('ref_no');
        $details = SupportTicket::checkByRef($ref_no);

        return $details;
    }
}
