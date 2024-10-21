<?php

namespace App\Livewire\Forms;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\WithFileUploads;

class EventForm extends Form
{

    public ?Event $event = null;

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

    public $picture;

    public $subject;

    public $slug;

    public $organizer_id;

    public $status = 'upcoming';

    public $venue_id;

    public $subcategories = [];

    public function rules()
    {
        $rules = [
            'name'        => 'bail|required|string|unique:events,name,',
            'description' => 'bail|string|required',
            'start_time'  => 'bail|required|date|after_or_equal:tomorrow',
            'end_time'    => 'bail|required|date|after_or_equal:tomorrow',
            'subject'     => 'bail|string',
            'picture'     => 'bail|'
            // 'organizer_id' => 'bail|required|int'
        ];

        $this->event ? $rules['name'] = $rules['name'] . $this->event->id : '';

        Auth::user()->role == 'organizer' ? $this->organizer_id = Auth::user()->id : null;

        return $rules;

    }

    public function setEvent(Event $event)
    {
        $this->event = $event;
        $this->name = $event->name;
        $this->description = str_replace('</p><p>', '\n', $event->description);
        $this->start_time = Carbon::createFromTimeString($event->start_time)->format('Y-m-d H:i');
        $this->end_time = Carbon::createFromTimeString($event->end_time)->format('Y-m-d H:i');
        $this->organizer_id = $event->organizer->id;
        $this->subcategories = $event->subcategories;
        $this->subject = $event->subject;
        $this->venue_id = $event->venue_id;
        // $this->picture = $event->picture;
    }

}
