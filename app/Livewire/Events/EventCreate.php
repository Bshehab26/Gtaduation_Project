<?php

namespace App\Livewire\Events;

use App\Livewire\Forms\EventForm;
use App\Models\Event;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EventCreate extends Component
{

    public EventForm $form;

    private $success;

    public function store()
    {
        $this->validate();

        $this->form->slug = str_replace(' ', '-', $this->form->name);

        $this->success = Event::create($this->form->except('event'));

        if($this->success){
            return redirect()->route('events.show', ['event' => $this->success]);
        }
    }

    public function render()
    {
        return view('livewire.events.event-create');
    }
}
