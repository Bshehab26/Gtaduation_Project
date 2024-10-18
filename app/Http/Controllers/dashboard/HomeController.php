<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Venue;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $featuredTicket = Ticket::select(DB::raw('`id`, MAX(`quantity` - `available`) as max'))
                            ->whereHas('event', function($q) {
                                $q->where('status', 'upcoming');
                            })
                            ->orderBy('max', 'asc')
                            ->groupBy('id')
                            ->firstOrFail();
        $featuredEvent = Event::with('venue')->whereHas('tickets', function($q) use ($featuredTicket){
                                $q->where('id', $featuredTicket->id);
                            })->firstOrFail();

        $venues = Venue::all();
        return view('home', compact('venues', 'featuredEvent'));

    }

    public function dashboard()
    {
        return view('dashboard.index');
    }

}
