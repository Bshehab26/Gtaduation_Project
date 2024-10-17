<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;

class RecentActivities extends Component
{
    public function render()
    {
        return view('livewire.components.recent-activities', [
            'admins' => User::where('role', 'admin')->orderBy('first_name')->get(),
        ]);
    }
}
