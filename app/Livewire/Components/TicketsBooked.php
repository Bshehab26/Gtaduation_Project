<?php

namespace App\Livewire\Components;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TicketsBooked extends Component
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

        return view('livewire.components.tickets-booked', [
            'sold' => Ticket::where('created_at', 'like', $filter)->sum(DB::raw('quantity - available')),
        ]);
    }
}
