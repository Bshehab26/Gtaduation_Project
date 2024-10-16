<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;

class UsersNumber extends Component
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

        return view('livewire.components.users-number', [
            'organizersCount' => User::where('role', 'organizer')->count(),
            'attendeesCount'  => User::where('role', 'customer')->count(),
        ]);
    }
}
