<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if(auth()->user()->type == 'admin'){
        //     //
        // }
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('events.show', [
            'event' => Event::with(['tickets', 'subcategories', 'organizer'])->findOrFail($event->id),
            'categories' => Category::whereHas('subcategories', function ($q) use ($event) {
                $q->whereHas('events', function ($q) use ($event) {
                    $q->where('events.id', $event->id);
                });
            })->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {

        // if(Auth::user()->id == $event->organizer->id){
        //     abort(403);
        // };

        return view('events.edit', [
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

}
