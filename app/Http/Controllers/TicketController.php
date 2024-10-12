<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Ticket, Event, User};


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::get();
        $user = User::get();
        $event = Event::with("tickets")->get();
        if (auth()->user()->user_type == "admin" || auth()->user()->user_type == "moderator") {
            return view("tickets.index", compact("tickets"));
        }else {
            return abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createTicket(string $id)
    {
        return view("tickets.create", compact("id"));
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
            'available' => 'required|numeric',
            'event_id'  => 'required|exists:events,id',
        ]);
        // return $request;
        Ticket::create($request->all());
        return redirect()->route("tickets.index")->with("success", "The ticket created succsessfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        return view("tickets.show", compact("ticket"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        if (auth()->user()->user_type == "admin") {
            $ticket = Ticket::findOrFail($id);
            return view("tickets.edit", compact("ticket", "id"));
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
            'available' => 'required|numeric',
            'event_id'  => 'required|exists:tickets,id',
        ]);
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());
        return redirect()->back()->with("success", "The ticket updated succsessfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        if (auth()->user()->user_type == "admin") {
        $ticket->delete();
        return redirect()->route("tickets.index")->with("success", "Ticket deleted successfully");
        }else{
            return redirect()->route("tickets.index")->with("unsuccess", "You can't delete ticket for another user");
            // return abort(403);
        }
    }
}
