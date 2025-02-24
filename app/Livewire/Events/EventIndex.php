<?php

namespace App\Livewire\Events;

use App\Models\Category;
use App\Models\Event;
use App\Models\Venue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public $orderType = 'desc';

    public $time = 'year';

    public $city;

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
        }
    }

    private function sorting(Builder $events)
    {
        switch ($this->orderQ) {
            case 'start':
                $this->orderBy = 'start_time';
                return $events->with(['venue', 'organizer'])->orderBy($this->orderBy, $this->orderType);
            case 'event':
                $this->orderBy = 'name';
                return $events->with(['venue', 'organizer'])->orderBy($this->orderBy, $this->orderType);
            case 'subject':
                $this->orderBy = 'subject';
                return $events->with(['venue', 'organizer'])->orderBy($this->orderBy, $this->orderType);
            case 'organizer':
                $this->orderBy = 'first_name';
                return $events->with(['venue', 'organizer'])->orderBy($this->orderBy, $this->orderType);
            case 'venue':
                $this->orderBy = 'venues.name';
                return $events->with(['organizer', 'venue' => function ($q) {
                    $q->orderBy($this->orderBy, $this->orderType);
                }]);
            default:
                $this->orderBy = 'start_time';
                return $events->with(['venue', 'organizer'])->orderBy($this->orderBy, $this->orderType);
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

    public function clear()
    {
        $this->reset();
    }

    private function searchFunciton(Builder $events, $search)
    {
        return $events->when($this->search, function ($q) use ($search){
            $q->where('name', 'like', "%$search%");
            $this->resetPage();
        });
    }

    private function filtering(Builder $events)
    {
        if($this->filters){
            foreach($this->filters as $i){
                $events->when($i, function($q) use ($i){
                    $q->whereHas('subcategories', function ($q) use ($i) {
                        $q->where('name', $i);
                    });
                });
            };
        };

        $city = $this->city;
        $events->when($city, function ($q) use ($city){
            $q->whereHas('venue', function ($q) use($city){
                $q->where('city', $city);
            });
        });

        $time = $this->time;
        $events->when($time, function($q) use ($time){
            switch ($time) {
                case 'week':
                    $q->where('start_time', '<=', Carbon::tomorrow()->addWeek()->format('Y-m-d'));
                    break;
                case 'month':
                    $q->where('start_time', '<=', Carbon::tomorrow()->addMonth()->format('Y-m-d'));
                    break;
                case 'year':
                    $q->where('start_time', '<=', Carbon::today()->addYear()->format('Y-m-d'));
                default:
                    $q->where('start_time', '<=', Carbon::tomorrow()->addYear()->format('Y-m-d'));
                    break;
            }
        });
    }

    public function render()
    {

        $events = Event::query();

        $this->sorting($events);

        $this->searchFunciton($events, $this->search);

        $this->filtering($events);

        return view('livewire.events.event-index', [
            'events'     => $events->where('start_time', '>=', Carbon::tomorrow()->format('Y-m-d'))
                                // ->where('status', 'upcoming')
                                ->paginate(10),
            'categories' => Category::with(['subcategories'])->limit(6)->get(),
            'cities'     => Venue::select('city')->distinct()->orderBy('city')->get(),
        ]);
    }
}
