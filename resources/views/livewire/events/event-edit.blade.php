@push('styles')
    <style>
        .form-control:focus{
            box-shadow: 0 0 0 0.25rem rgba(248, 34, 73, 0.25);
            border: solid 1px rgba(248, 34, 73, 1)
        }
        form label{
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            color: #0e1b4d;
        }
    </style>
@endpush

@session('success')
    <div class="p-3">
        <div class="alert alert-success container p-2">
            <p class="row py-2 px-4">{{ $value }}</p>
            <div class="row d-flex justify-content-around text-center">
                <a href="{{ route('events.show', ['event' => $form->slug]) }}" class="col-sm-4">
                    Show event
                </a>
                <a href="{{ route('events.index', ['event' => $form->slug]) }}" class="col-sm-4">
                    Show events
                </a>
            </div>
        </div>
    </div>
@endsession

<form
    method="POST"
    wire:submit='update'
    class="form input-group w-50 mx-auto d-flex flex-column fs-4 p-3"
    style="gap: 1rem;">

    <div class="container section-title py-0">
        <h2>Event information<br></h2>
    </div>

    <div class="form-group w-100">
        <label class="d-block" for="event-name">Event Name<span class="text-danger">*</span>:</label>
        <input
            wire:model='form.name'
            id="event-name"
            class="form-control"
            name="name"
            type="text"
            placeholder="What's the event?"
            value="{{ $form->name }}"
            required>
        @error('form.name')
            <p class="text-danger" style="font-size: 1rem;">*{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label class="d-block" for="event-subject">Event Subject:</label>
        <input
            wire:model='form.subject'
            id="event-subject"
            class="form-control"
            type="text"
            placeholder="What's the event about?"
            required>
        @error('form.subject')
            <p class="text-danger" style="font-size: 1rem;">*{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label class="d-block" for="event-description">Event description<span class="text-danger">*</span>:</label>
        <textarea
            wire:model='form.description'
            id="event-description"
            class="w-100 form-control"
            name="description"
            style="height: 10rem;"
            placeholder="Can you explain more?" required
            ></textarea>
        @error('form.description')
            <p class="text-danger" style="font-size: 1rem;">*{{ $message }}</p>
        @enderror
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="start-time">Starts in<span class="text-danger">*</span>:</label>
            <input
                wire:model='form.start_time'
                id="start-time"
                class="form-control"
                name="start_time"
                type="datetime-local"
                required>
        </div>
        <div class="form-group col-md-6">
            <label for="end-time">Ends in<span class="text-danger">*</span>:</label>
            <input
                wire:model='form.end_time'
                id="end-time"
                class="form-control"
                name="end_time"
                type="datetime-local"
                required>
        </div>
        @error('form.start_time')
            <p class="text-danger" style="font-size: 1rem;">*{{ $message }}</p>
        @enderror
        @error('form.end_time')
            <p class="text-danger" style="font-size: 1rem;">*{{ $message }}</p>
        @enderror
    </div>

    <hr class="w-100 my-4" style="background-color: #0e1b4d;">

    <div class="container section-title py-0">
        <h2>Venue information<br></h2>
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

    <hr class="w-100 my-4" style="background-color: #0e1b4d;">

    {{-- CATEGORY INFROMATION --}}
    <div class="container section-title py-0">
        <h2 class="card-title">Category information:</h2>
        <div class="row mb-3">
            <div class="row my-4 mx-auto">
                <div class="col-12">
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
            <div class="row my-4 mx-auto">
                <div class="p-2 rounded col-12">
                    <h5
                        id="event-dropdown-toggle"
                        class="fs-4 dorpdown-toggle my-4"
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
                            <button wire:key='{{ $sub->id }}' wire:click='addSub({{ $sub->id }})' type="button" class="btn btn-light border my-1">{{ $sub->name }} <i class="bi bi-plus"></i></button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END CATEGORY INFROMATION --}}

    <button type="submit" class="btn my-2 border border-danger rounded text-white" style="background-color: rgba(248, 34, 73);">Submit</button>
</form>
