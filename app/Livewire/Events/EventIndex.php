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

    public function render()
    {

        $events = Event::query();
        $search = $this->search;

        $events->when($this->search, function ($q) use ($search){
            $q->where('name', 'like', "%$search%");
        });

        return view('livewire.events.event-index', [
            // 'events' => $events->where('start_time', '>=', Carbon::tomorrow()->format('Y-m-d'))
            //             ->where('status', 'upcoming')
            //             ->orderBy($this->orderBy, $this->orderType)
            //             ->paginate(10),
            'events' => $events->orderBy($this->orderBy, $this->orderType)->paginate(10),
        ]);
    }
}
