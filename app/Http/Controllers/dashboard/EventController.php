<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.events.index', [
            'events' => Event::with(['organizer', 'subcategories'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.events.create');
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
        return view('dashboard.events.show', [
            'event' => $event,
            'events' => Event::with(['organizer', 'subcategories'])->orderBy('name', 'asc')->get(),
            'categories' => Category::whereHas('subcategories', function($q) use ($event) {
                $q->whereHas('events', function($q) use ($event){
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
        return view('dashboard.events.edit', [
            'events' => Event::orderBy('name', 'asc')->get(),
            'event' => Event::with('subcategories')->findOrFail($event->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if(auth()->user()->role !== 'admin') {
            abort(403);
        }
        $event->delete();
        return back()->with('success', 'Event deleted successfully');
    }

    public function trash()
    {
        return view('dashboard.events.trash', [
            'events' => Event::onlyTrashed()->get(),
        ]);
    }

    public function forceDelete(string $id)
    {
        Event::withTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Event deleted successfully');
    }

    public function restore(string $id)
    {
        Event::withTrashed()->find($id)->restore();
        return back()->with('success', 'Eevent restored.');
    }
}
