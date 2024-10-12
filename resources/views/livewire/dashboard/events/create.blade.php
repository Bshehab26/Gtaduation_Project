
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

<form wire:submit='store'>
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

    <h5 class="card-title">Venue information:</h5>

    <div class="d-flex justify-content-lg-center">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>
