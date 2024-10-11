<?php

namespace App\Livewire\Dashboard\Events;

use App\Livewire\Forms\EventForm;
use App\Models\Event;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Edit extends Component
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

        if($this->success){
            Session::flash('success', 'From updated successfully.');
        }

    }

    public function changeEvent(Event $event)
    {
        $this->form->event = $event;
        $this->form->setEvent($event);
    }

    public function render()
    {
        return view('livewire.dashboard.events.edit', [
            'events' => Event::orderBy('name', 'asc')->get(),
        ]);
    }
}
