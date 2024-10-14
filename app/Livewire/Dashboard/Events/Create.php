<?php

namespace App\Livewire\Dashboard\Events;

use App\Livewire\Forms\EventForm;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{

    public EventForm $form;

    public $orgSearch;

    public $success;

    public function store()
    {
        $this->validate();

        $this->form->description = str_replace('\n', '</p><p>', $this->form->description);

        $this->form->slug = str_replace(' ', '-', $this->form->name);

        $this->success = Event::create($this->form->except('event'));

        if($this->success){
            Session::flash('success', 'Event created successfully.');
        };

    }

    public function render()
    {

        $orgSearch = $this->orgSearch;

        return view('livewire.dashboard.events.create', [
            'organizers' => User::where('role', 'organizer')
                            ->when($orgSearch, function($q) use ($orgSearch) {
                                $q->where('first_name', 'like', "%$orgSearch%")
                                    ->orWhere('last_name', 'like', "%$orgSearch");
                            })
                            ->orderBy('first_name')
                            ->get(),
        ]);
    }
}
