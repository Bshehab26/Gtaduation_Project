<?php

namespace App\Livewire\Dashboard\Events;

use App\Livewire\Forms\EventForm;
use App\Models\Category;
use App\Models\Event;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Edit extends Component
{

    public EventForm $form;

    public $success;

    public $orgSearch;

    public $currentCategoryId = 1;

    public $categoriesList = [];

    public function mount(Event $event)
    {
        $this->form->setEvent($event);
    }

    public function addSub($sub)
    {
        $this->form->event->subcategories()->syncWithoutDetaching($sub);
    }

    public function removeSub($sub)
    {
        $this->form->event->subcategories()->detach($sub);
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

        $orgSearch = $this->orgSearch;
        $event = $this->form->event;

        return view('livewire.dashboard.events.edit', [
            'events'          => Event::orderBy('name', 'asc')->get(),
            'event'           => Event::with('subcategories')->findOrFail($this->form->event->id),
            'organizers'      => User::where('role', 'organizer')
                                    ->when($orgSearch, function($q) use ($orgSearch) {
                                        $q->where('first_name', 'like', "%$orgSearch%")
                                            ->orWhere('last_name', 'like', "%$orgSearch");
                                    })
                                    ->orderBy('first_name')
                                    ->get(),
            'categories'      => Category::whereHas('subcategories', function($q) use ($event) {
                                        $q->whereHas('events', function($q) use ($event){
                                            $q->where('events.id', $event->id);
                                        });
                                    })->get(),
            'allCategories'      => Category::orderBy('name')->get(),
            'currentCategory' => Category::with(['subcategories'])->findOrFail($this->currentCategoryId),
        ]);
    }
}
