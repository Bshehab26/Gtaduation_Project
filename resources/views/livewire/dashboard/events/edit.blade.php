
@session('success')
    <div class="p-3">
        <div class="alert alert-success container p-2">
            <p class="row py-2 px-4">{{ $value }}</p>
            <div class="row d-flex justify-content-around text-center">
                <a href="{{ route('dashboard.events.show', ['event' => $form->slug]) }}" class="col-sm-4">
                    Show event
                </a>
                <a href="{{ route('dashboard.events.create') }}" class="col-sm-4">
                    Add new event
                </a>
                <a href="{{ route('events.show', ['event' => $form->slug]) }}" class="col-sm-4">
                    Show event in website
                </a>
            </div>
        </div>
    </div>
@endsession

<form wire:submit='update'>
    <h5 class="card-title">Event information:</h5>
    <div class="row mb-3">
        <label for="name" class="col-sm-2 col-form-label">Name<span class="text-danger">*</span>:</label>
        <div class="col-sm-10">
            <input wire:model='form.name' type="text" id="name" name="name" class="form-control">
            @error('form.name')
                <p class="text-danger" style="font-size:1rem;">*{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="subject" class="col-sm-2 col-form-label">Subject<span class="text-danger">*</span>:</label>
        <div class="col-sm-10">
            <input wire:model='form.subject' type="text" id="subject" name="subject" class="form-control">
            @error('form.subject')
                <p class="text-danger" style="font-size:1rem;">*{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="description" class="col-sm-2 col-form-label">Description<span class="text-danger">*</span>:</label>
        <div class="col-sm-10">
            <textarea wire:model='form.description' class="form-control" id="description" style="height: 100px"></textarea>
            @error('form.description')
                <p class="text-danger" style="font-size:1rem;">*{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="start-time" class="col-sm-2 col-form-label">Sart time<span class="text-danger">*</span>:</label>
        <div class="col-sm-10">
            <input wire:model='form.start_time' id="start-time" type="datetime-local" class="form-control">
            @error('form.start_time')
                <p class="text-danger" style="font-size:1rem;">*{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="end-time" class="col-sm-2 col-form-label">End time<span class="text-danger">*</span>:</label>
        <div class="col-sm-10">
            <input wire:model='form.end_time' id="end-time" type="datetime-local" class="form-control">
            @error('form.end_time')
                <p class="text-danger" style="font-size:1rem;">*{{ $message }}</p>
            @enderror
        </div>
    </div>

    <hr class="w-100 my-4">

    {{-- ORGANIZER INFORMATION SECIOTN --}}
    <h5 class="card-title">Organizer information:</h5>
    <div class="row mb-3 w-100">
        <label for="organizer-search" class="col-sm-3 col-form-label">Search for organizer:</label>
        <div class="col-9">
            <input wire:model.live.debounce.50ms='orgSearch' id="organizer-search" type="text" class="form-control">
        </div>
    </div>

    <div class="row mb-3 w-100">
        <label for="organizer" class="col-2 col-form-label">Organizer<span class="text-danger">*</span>:</label>
        <div class="col-10">
            <select wire:model='form.organizer_id' name="organizer" class="form-select" aria-label="multiple select example">
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->id }}">{{ $organizer->fullName() }}</option>
                @endforeach
            </select>
            @error('form.organizer_id')
                <p class="text-danger" style="font-size:1rem;">*{{ $message }}</p>
            @enderror
        </div>
    </div>
    {{-- END ORGANIZER INFORMATION SECIOTN --}}

    <hr class="w-100 my-4">

    <div>
        <h5 class="card-title">Venue information:</h5>
        <div class="row mb-3 w-100">
            <label for="venue-search" class="col-sm-3 col-form-label">Search for venue:</label>
            <div class="col-9">
                <input wire:model.live.debounce.50ms='venueSearch' id="venue-search" type="text" class="form-control">
            </div>
        </div>
        <div class="row mb-3 w-100">
            <label for="venue" class="col-2 col-form-label">Venue<span class="text-danger">*</span>:</label>
            <div class="col-10">
                <select wire:model='form.venue_id' name="venue" class="form-select" aria-label="multiple select example">
                    @foreach ($venues as $venue)
                        <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                    @endforeach
                </select>
                @error('form.veneu_id')
                    <p class="text-danger" style="font-size:1rem;">*{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <hr class="w-100 my-4">

    {{-- CATEGORY INFROMATION --}}
    <div>
        <h5 class="card-title">Category information:</h5>
        <div class="row mb-3 w-100">
            <div class="row my-4">
                <h5 class="col-3">Categories:</h5>
                <div class="col-9">
                    @forelse ($categories as $category)
                        <h5 style="font-weight: bold;">{{ $category->name }}</h5>
                        <div class="d-flex flex-wrap" style="gap: 1rem;">
                            @foreach ($eventSubcategories as $sub)
                                @if ($sub->category->id == $category->id)
                                    <button wire:key='{{ $sub->id }}' wire:click='removeSub({{ $sub->id }})' type="button" class="btn btn-light border">{{ $sub->name }} <i class="bi bi-x"></i></button>
                                @endif
                            @endforeach
                        </div>
                        <hr>
                    @empty
                    <h5 style="font-weight: bold;">N/A</h5>
                    @endforelse
                </div>
            </div>
            <div class="row my-4">
                <h5 class="col-3">Add more categories:</h5>
                <div class="p-2 rounded col-9">
                    <h5
                        id="event-dropdown-toggle"
                        class="fs-4 dorpdown-toggle"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        style="cursor: pointer; display:inline-block; font-size:1rem;"
                        >{{ $currentCategory->name }} <i class="bi bi-chevron-down toggle-dropdown"></i></h5>
                    <div class="dropdown">
                        <ul class="dropdown-menu overflow-y-scroll" style="height: 15rem;" aria-labelledby="event-dropdown-toggle">
                            @foreach ($allCategories as $category)
                                <li class="dropdown-item p-0" style="cursor: pointer;" wire:key='{{ $category->id }}'>
                                    <button
                                        type="button"
                                        wire:click="$set('currentCategoryId', {{ $category->id }})"
                                        class="text-black btn w-100">
                                        {{ $category->name }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                        @foreach ($currentCategory->subcategories as $sub)
                            @php
                                if (in_array($sub->id, $subcategoriesIds)){
                                    continue;
                                }
                            @endphp
                            <button wire:key='{{ $sub->id }}' wire:click='addSub({{ $sub->id }})' type="button" class="btn btn-light border">{{ $sub->name }} <i class="bi bi-plus"></i></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END CATEGORY INFROMATION --}}

    <div class="d-flex justify-content-lg-center">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>
@push('styles')
    <style>
        textarea {
            white-space: pre-wrap;
        }
    </style>
@endpush
