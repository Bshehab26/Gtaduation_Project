<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Ticket, User, Event};


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = User::get();
        $tickets = Ticket::with("event")->get();
        if (auth()->user()->role == "admin" || auth()->user()->role == "moderator") {
            return view("tickets.index", compact("tickets"));
        }else {
            return abort(403);
        }
    }
    public function ticketStatus(string $event_id)
    {
        $event = Event::where("id", $event_id)->with("tickets")->first();
            $organizer = Event::findOrFail($event_id)->organizer;
            if (auth()->user()->role == "organizer" && auth()->user()->id == $organizer->id) {
                return view("tickets.statusIndex", compact("event"));
            }elseif(auth()->user()->role == "admin" || auth()->user()->role == "moderator"){
                return view("tickets.statusIndex", compact("event"));
            }else {
                return abort(403);
            }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createTicket(string $event_id)
    {
        $event = Event::where("id", $event_id)->with("tickets")->first();
        return view("tickets.create", compact("event"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type'      => 'required|string|max:255',
            'price'     => 'required|numeric',
            'quantity'  => 'required|numeric',
            // 'available' => 'required|numeric',
            'event_id'  => 'required|exists:events,id',
        ]);
        $request->merge([
            "available" => $request->quantity,
        ]);
        // return $request;
        Ticket::create($request->all());
        return redirect()->route("ticket-status.index", $request->event_id)->with("success", "The ticket created succsessfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $organizer = Ticket::findOrFail($id)->event->organizer;
        if (auth()->user()->role == "admin" || (auth()->user()->role == "moderator" && auth()->user()->role != "admin") || (auth()->user()->role == "organizer" && auth()->user()->id == $organizer->id)) {
            return view("tickets.show", compact("ticket"));
        }else{
            return abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $organizer = Ticket::findOrFail($id)->event->organizer;
        if (auth()->user()->role == "admin" || (auth()->user()->role == "moderator" && auth()->user()->id == $organizer->id) || (auth()->user()->role == "organizer" && auth()->user()->id == $organizer->id)) {
            $ticket = Ticket::where("id", $id)->with("event")->first();
            $event = $ticket->event;
            return view("tickets.edit", compact("ticket", "event"));
        }else{
            return redirect()->route("tickets.index")->with("unsuccess", "You can't edit ticket for another user");
            // return abort(403);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type'      => 'required|string|max:255',
            'price'     => 'required|numeric',
            'quantity'  => 'required|numeric',
            // 'available' => 'required|numeric',
            'event_id'  => 'required|exists:tickets,event_id',
        ]);
        $ticket = Ticket::findOrFail($id);
        $new_available = $ticket->available + $request->quantity - $ticket->quantity;
        if ($new_available < 0 ) {
            return redirect()->back()->with("success", "You can't remove tickets already reserved");
        }
        $request->merge([
            "available" => $new_available,
        ]);
        $ticket->update($request->all());
        return redirect()->route("ticket-status.index", $request->event_id)->with("success", "The ticket updated succsessfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $organizer = Ticket::findOrFail($id)->event->organizer;
        $ticket = Ticket::findOrFail($id);
        if (auth()->user()->role == "admin" || (auth()->user()->role == "organizer" && auth()->user()->id == $organizer->id) || (auth()->user()->role == "moderator" && auth()->user()->id == $organizer->id)) {
        $ticket->delete();
        return redirect()->back()->with("success", "Ticket deleted successfully");
        }else{
            return redirect()->back()->with("unsuccess", "You can't delete ticket for another user");
            // return abort(403);
        }
    }
    public function ticketDecrease(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        if ($ticket->available <= 0) {
            return redirect()->back()->with("success", "Sorry All Tickets are already reserved ");
        }
        $ticket->available -= 1;
        $ticket->update($ticket->only(["available"]));
        return redirect()->back()->with("success", "Ticket reserved successfully");
    }
}
