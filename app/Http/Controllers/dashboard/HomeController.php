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
        $featuredTicket = Ticket::select(DB::raw('`id`, MAX(`quantity` - `available`)'))
                            ->whereHas('event', function($q) {
                                $q->where('status', 'upcoming')->orderBy('start_time');
                            })
                            ->groupBy('id')
                            ->firstOrFail();
                            // dd($featuredTicket);
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
