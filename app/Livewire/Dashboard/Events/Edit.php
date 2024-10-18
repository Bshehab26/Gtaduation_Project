<?php

namespace App\Livewire\Dashboard\Events;

use App\Livewire\Forms\EventForm;
use App\Models\Category;
use App\Models\Event;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Edit extends Component
{

    public EventForm $form;

    public $success;

    public $currentCategoryId;

    public $orgSearch;

    public $venueSearch;

    public $subcategoriesIds = [];

    public function mount(Event $event)
    {
        $this->form->setEvent($event);
        foreach($this->form->subcategories as $sub){
            $this->subcategoriesIds[] = $sub->id;
        };
    }

    public function addSub($id)
    {
        $this->subcategoriesIds[] = $id;
    }

    public function removeSub($id)
    {
        if($index = array_search($id, $this->subcategoriesIds)){
            unset($this->subcategoriesIds[$index]);
        };
    }

    public function update()
    {
        $this->validate();

        $this->form->slug = str_replace(' ', '-', $this->form->name);

        $this->success = $this->form->event->update($this->form->except(['event', 'subcategories']));
        $this->form->event->subcategories()->sync($this->subcategoriesIds);

        if($this->success){
            session()->flash('success', 'Event updated successfully.');
        }

    }

    public function render()
    {

        $venueSearch = $this->venueSearch;
        $orgSearch = $this->orgSearch;
        $subcategories = $this->subcategoriesIds;

        return view('livewire.dashboard.events.edit', [
            'organizers'      => User::where('role', 'organizer')
                                    ->when($orgSearch, function($q) use ($orgSearch) {
                                        $q->where('first_name', 'like', "%$orgSearch%")
                                            ->orWhere('last_name', 'like', "%$orgSearch");
                                    })
                                    ->orderBy('first_name')
                                    ->get(),
            'categories'         => Category::whereHas('subcategories', function($q) use    ($subcategories) {
                                        $q->whereIn('id', $subcategories);
                                    })->get(),
            'eventSubcategories' => Subcategory::whereIn('id', $subcategories)
                                    ->get(),
            'allCategories'      => Category::orderby('name', 'asc')->get(),
            'currentCategory'    => $this->currentCategoryId ? Category::with(['subcategories'])
                                    ->findOrFail($this->currentCategoryId) : Category::with(['subcategories'])
                                    ->orderBy('name')
                                    ->firstOrFail(),
            'venues'             => Venue::when($venueSearch, function($q) use ($venueSearch){
                                        $q->where('name', 'like', "%$venueSearch%");
                                    })->orderBy('name', 'asc')->get(),
        ]);
    }
}
