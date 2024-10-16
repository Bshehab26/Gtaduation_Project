<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use PhpParser\Node\Expr\Cast\String_;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticket = Ticket::with(['event'])->findOrFail($request['ticket']);
        $attributes = $request->validate([
            'quantity' => 'bail|required|between:1,' . $ticket->available,
        ]);
        $attributes['total_price'] = $request['quantity'] * $ticket->price;
        $attributes['attendee_id'] = auth()->user()->id;
        $attributes['event_id'] = $ticket->event->id;
        $attributes['ticket_id'] = $ticket->id;

        $ticket->update(['available' => $ticket->available - $request['quantity']]);

        Booking::create($attributes);
        return redirect()->back()->with('success', "You've booked successfully for this event, enjoy!");

    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
