<?php

namespace App\Livewire\Events;

use App\Livewire\Forms\EventForm;
use App\Models\Category;
use App\Models\Event;
use App\Models\Subcategory;
use App\Models\Venue;
use Livewire\Component;

class EventCreate extends Component
{

    public EventForm $form;

    private $success;

    public $currentCategoryId;

    public $venueSearch;

    public $subcategoriesIds = [];

    public function addSub($id)
    {
        $this->subcategoriesIds[] = $id;
        $this->form->subcategories[] = Subcategory::with('category')->findOrFail($id);
    }

    public function removeSub($id)
    {
        $index = array_search($id, $this->subcategoriesIds);
        if( $index >= 0){
            unset($this->subcategoriesIds[$index]);
        };
    }

    public function store()
    {
        $this->validate();

        $this->form->slug = str_replace(' ', '-', $this->form->name);

        $this->success = Event::create($this->form->except(['event', 'subcategories']));
        $this->success->subcategories()->syncWithoutDetaching($this->subcategoriesIds);

        if($this->success){
            return redirect()->route('events.show', ['event' => $this->success]);
        }
    }

    public function render()
    {

        $subcategories = $this->subcategoriesIds;
        $venueSearch = $this->venueSearch;

        return view('livewire.events.event-create', [
            'categories'      => Category::whereHas('subcategories', function($q) use ($subcategories) {
                                        $q->whereIn('id', $subcategories);
                                    })->get(),
            'allCategories'   => Category::orderby('name', 'asc')->get(),
            'currentCategory' => $this->currentCategoryId ? Category::with(['subcategories'])
                                    ->findOrFail($this->currentCategoryId) : Category::with(['subcategories'])
                                    ->orderBy('name')
                                    ->firstOrFail(),
            'eventSubcategories' => Subcategory::whereIn('id', $subcategories)
                                    ->get(),
            'venues'             => Venue::when($venueSearch, function($q) use ($venueSearch) {
                                        $q->where('name', 'like', "%$venueSearch%");
                                    })->orderBy('name')->get(),
        ]);
    }
}
