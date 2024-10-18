<?php

namespace App\Livewire\Components;

use App\Models\Booking;
use Livewire\Component;

class BookingTable extends Component
{

    public $filter = 'this year';

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

        return view('livewire.components.booking-table', [
            'bookings' => Booking::latest()->with(['ticket', 'event', 'attendee'])->where('created_at', 'like', $filter)->get(),
        ]);
    }
}
