<?php

namespace App\Livewire\Events;

use App\Livewire\Forms\EventForm;
use App\Models\Event;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class EventEdit extends Component
{

    public EventForm $form;

    public $success;

    public function mount(Event $event)
    {
        $this->form->setEvent($event);
    }

    public function update()
    {
        $this->validate();

        $this->form->slug = str_replace(' ', '-', $this->form->name);

        $this->success = $this->form->event->update($this->form->except('event')) ? 'Event updated successfuly.' : false;

    }

    public function render()
    {
        return view('livewire.events.event-edit');
    }
}
