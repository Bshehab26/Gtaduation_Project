<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;

class EventSchedule extends Component
{

    public $date;

    public $day = 0;

    public function changeDate($day)
    {
        $this->date = $day;
        $this->day = $day;
    }

    public function render()
    {
        return view('livewire.events.event-schedule', [

            'events' => Event::where('start_time', 'like', Carbon::tomorrow()->addDays($this->date)->format('Y-m-d') . '%')
                                ->where('status', 'upcoming')
                                ->orderBy('start_time', 'asc')
                                ->limit(5)
                                ->get(),

        ]);
    }
}
