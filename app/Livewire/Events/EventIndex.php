<?php

namespace App\Livewire\Events;

use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class EventIndex extends Component
{

    use WithPagination;

    public $search;
    public $category1;
    public $category2;
    public $category3;
    public $category4;
    public $category5;
    public $category6;
    public $filters = [];
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

    public function filter()
    {
        $this->filters[0] = $this->category1;
        $this->filters[1] = $this->category2;
        $this->filters[2] = $this->category3;
        $this->filters[3] = $this->category4;
        $this->filters[4] = $this->category5;
        $this->filters[5] = $this->category6;
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

        if($this->filters){
            foreach($this->filters as $i){
                $events->when($i, function($q) use ($i){
                    $q->whereHas('subcategories', function ($q) use ($i) {
                        $q->where('name', $i);
                    });
                });
            };
        }

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
            'categories' => Category::with(['subcategories'])->limit(6)->get(),
        ]);
    }
}
