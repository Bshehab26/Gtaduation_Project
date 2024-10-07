<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class EventIndex extends Component
{

    use WithPagination;

    public $search;
    // public $food;
    // public $drink;
    // public $venue;
    public $orderQ;
    public $orderBy = 'start_time';
    public $orderType = 'asc';
    public $time = 'This year';
    public $duration;

    public function order($order)
    {
        if($this->orderQ == $order){
            if($this->orderType == 'asc'){
                $this->orderType = 'desc';
            } else {
                $this->orderType = 'asc';
            };
        } else {
            $this->orderQ = $order;
            $this->orderType = 'asc';
            switch ($order) {
                case 'start':
                    $this->orderBy = 'start_time';
                    break;
                case 'event':
                    $this->orderBy = 'name';
                    break;
            }
        }
    }

    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {

        $events = Event::query();
        $search = $this->search;
        $time = $this->time;
        $duration = $this->duration;

        $events->when($this->search, function ($q) use ($search){
            $q->where('name', 'like', "%$search%");
            $this->resetPage();
        });

        $events->when($time, function($q) use ($time){
            switch ($time) {
                case 'This week':
                    $q->where('start_time', '<=', Carbon::tomorrow()->addWeek()->format('Y-m-d'));
                    break;
                case 'This month':
                    $q->where('start_time', '<=', Carbon::tomorrow()->addMonth()->format('Y-m-d'));
                    break;
                case 'This year':
                    $q->where('start_time', '<=', Carbon::today()->addYear()->format('Y-m-d'));
                default:
                    $q->where('start_time', '<=', Carbon::tomorrow()->addYear()->format('Y-m-d'));
                    break;
            }
        });

        return view('livewire.events.event-index', [
            'events' => $events->where('start_time', '>=', Carbon::tomorrow()->format('Y-m-d'))
                        // ->where('status', 'upcoming')
                        ->orderBy($this->orderBy, $this->orderType)
                        ->paginate(10),
        ]);
    }
}
