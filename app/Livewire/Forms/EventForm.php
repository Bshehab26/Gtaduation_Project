<?php

namespace App\Livewire\Forms;

use App\Models\Event;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventForm extends Form
{

    public ?Event $event;

    // // #[Validate('bail|required|string|unique:events,name,'. $this->event->name)]
    public $name;

    // #[Validate('bail|string|required')]
    public $description;

    // // #[Validate('bail|required|max:255')]
    // public $subject;

    // #[Validate('bail|required|date|after_or_equal:tomorrow')]
    public $start_time;

    // #[Validate('bail|required|date')]
    public $end_time;

    public $slug;

    public $status = 'upcoming';

    public function rules()
    {
        return [
            'name' => 'bail|required|string|unique:events,name,'. $this->event->id,
            'description' => 'bail|string|required',
            'start_time' => 'bail|required|date|after_or_equal:tomorrow',
            'end_time' => 'bail|required|date',
        ];
    }

    public function setEvent(Event $event)
    {
        $this->event = $event;
        $this->name = $event->name;
        $this->description = $event->description;
        $this->start_time = $event->start_time;
        $this->end_time = $event->end_time;
    }

}
