<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class EventSchedule extends Component
{

    public function render()
    {
        return view('livewire.events.event-schedule', [

            'eventsDay1' => Event::where('start_time', 'like', Carbon::today()->format('Y-m-d') . '%')
                                ->where('status', 'upcoming')
                                ->orderBy('start_time', 'asc')
                                ->get(),

            'eventsDay2' => Event::where('start_time', 'like', Carbon::today()->addDay()->format('Y-m-d') . '%')
                                ->where('status', 'upcoming')
                                ->orderBy('start_time', 'asc')
                                ->get(),

            'eventsDay3' => Event::where('start_time', 'like', Carbon::today()->addDays(2)->format('Y-m-d') . '%')
                                ->where('status', 'upcoming')
                                ->orderBy('start_time', 'asc')
                                ->get(),

        ]);
    }
}
