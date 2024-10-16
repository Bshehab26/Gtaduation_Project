<?php

namespace App\Livewire\Components;

use App\Models\Event;
use Livewire\Component;

class EventCreated extends Component
{

    public $filter = 'today';

    public function render()
    {

        switch ($this->filter) {
            case 'today':
                $filter = \Carbon\Carbon::today()->format('Y-m-d') . '%';
                break;
            case 'this month':
                $filter = '%' . \Carbon\Carbon::now()->format('Y-m') . '%';
                break;
            case 'this year':
                $filter = '%' . \Carbon\Carbon::now()->format('Y') . '%';
                break;
        }

        return view('livewire.components.event-created', [
            'countEvent' => Event::where('created_at', 'like',  $filter)->count(),
        ]);
    }
}
