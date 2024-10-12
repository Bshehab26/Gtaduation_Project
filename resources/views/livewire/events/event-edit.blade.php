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

@if ($success)
    <div class="alert alert-success">
        {{ $success }}
    </div>
@endif

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
    {{-- <div class="form-group">
        <label class="d-block" for="event-subject">Event Subject:</label>
        <input
            wire:model='subject'
            id="event-subject"
            class="form-control"
            type="text"
            placeholder="What's the event about?"
            required>
        @error('form.subject')
            <p class="text-danger" style="font-size: 1rem;">*{{ $message }}</p>
        @enderror
    </div> --}}
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
    </div>

    <button type="submit" class="btn my-2 border border-danger rounded text-white" style="background-color: rgba(248, 34, 73);">Submit</button>
</form>
