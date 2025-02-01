<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class supportTicketController extends Controller
{
    public function allTickets(Request $request)
    {
        return view('pages.dashboard.index');
    }

    public function allTicketDetails(Request $request)
    {

        $allTicketDetails = SupportTicket::orderBy('id', 'desc')->paginate(10);

        return response()->json([
            'status' => 200,
            'ticket_details' => $allTicketDetails,
        ]);
    }

    public function ticketSearchByCustomer(Request $request)
    {
        $textCustomerName = $request->input('textCustomerName');
        if ($textCustomerName == null) {
            $allTicketDetails  = SupportTicket::orderBy('id', 'desc')->paginate(10);
        } else {
            $allTicketDetails  = SupportTicket::orderBy('id', 'desc')->where('customer_name', 'like', '%' . $textCustomerName . '%')->paginate(10);
        }
        return response()->json([
            'status' => 200,
            'ticket_details' => $allTicketDetails,
        ]);
    }

    public function view($ticket_id)
    {
        $ticket = SupportTicket::find($ticket_id);
        $ticket->isView = true;
        $ticket->status = "Open";
        $ticket->save();
        return view('pages.dashboard.viewTicket')->with(['ticket' => $ticket]);
    }

    public function storeReply(Request $request)
    {
        request()->validate([
            'reply'  => 'required',
        ]);

        $reply = $request->input('reply');
        $ReplyComment  = new Reply();
        $ReplyComment->support_ticket = $request->input('postId');
        $ReplyComment->reply = $reply;

        $saved = $ReplyComment->save();
        if (!$saved) {
            App::abort(500, 'Error');
        }

        $SupportTicket = SupportTicket::find($request->input('postId'));
        $SupportTicket->status = "Closed";
        $SupportTicket->update();

        $details = [
            'title' => 'Ticket Reply, Ref No: ' . $SupportTicket->ref_no,
            'body' => $reply,
            'status' => 'Closed'
        ];

        Mail::to($SupportTicket->email)->send(new \App\Mail\ticketStatusMail($details));

        return Response()->json([
            "success" => true,
            "ref_no" => $SupportTicket->ref_no
        ]);
    }

    public function deleteTicket($id)
    {
        $reply = Reply::where('support_ticket', $id)->first();
        if ($reply) {
            $reply->delete();
        }

        $ticket = SupportTicket::findOrFail($id);
        $ticket->delete();

        return response()->json(['status' => 200, 'message' => 'Ticket deleted successfully']);
    }
}
