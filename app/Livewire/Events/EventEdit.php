<?php

namespace App\Livewire\Events;

use App\Livewire\Forms\EventForm;
use App\Models\Category;
use App\Models\Event;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class EventEdit extends Component
{

    public EventForm $form;

    public $success;

    public $currentCategoryId;

    public $subcategoriesIds;

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

        $subcategories = $this->subcategoriesIds;

        return view('livewire.events.event-edit', [
            'categories'         => Category::whereHas('subcategories', function($q) use ($subcategories) {
                                        $q->whereIn('id', $subcategories);
                                    })->get(),
            'eventSubcategories' => Subcategory::whereIn('id', $subcategories)
                                    ->get(),
            'allCategories'      => Category::orderby('name', 'asc')->get(),
            'currentCategory'    => $this->currentCategoryId ? Category::with(['subcategories'])
                                    ->findOrFail($this->currentCategoryId) : Category::with(['subcategories'])
                                    ->orderBy('name')
                                    ->firstOrFail(),
        ]);
    }
}
