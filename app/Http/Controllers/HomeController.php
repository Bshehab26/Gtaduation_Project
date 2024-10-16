<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featuredTicket = Ticket::select(DB::raw('`id`, MAX(`quantity` - `available`)'))
                            ->whereHas('event', function($q) {
                                $q->where('status', 'upcoming')->orderBy('start_time');
                            })
                            ->groupBy('id')
                            ->firstOrFail();
        $featuredEvent = Event::with('venue')->whereHas('tickets', function($q) use ($featuredTicket){
                                $q->where('id', $featuredTicket);
                            })->firstOrFail();
        return view('home', [
            'featuredEvent' => $featuredEvent,
        ]);
    }
}
