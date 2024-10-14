<div class="row mb-3">
    <label for="type" class="col-sm-2 col-form-label">type</label>
    <div class="col-sm-10">
        <input type="text" id="type" name="type" class="form-control" value="{{ old('type', $ticket->type) }}">
    </div>
</div>

<div class="row mb-3">
    <label for="price" class="col-sm-2 col-form-label">Price</label>
    <div class="col-sm-10">
        <input type="text" id="price" name="price" class="form-control" value="{{ old('price', $ticket->price) }}">
    </div>
</div>
<div class="row mb-3">
    <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
    <div class="col-sm-10">
        <input type="text" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $ticket->quantity) }}">
    </div>
</div>
<div class="row mb-3">
    <label for="available" class="col-sm-2 col-form-label">Available</label>
    <div class="col-sm-10">
        <input type="text" id="available" name="available" class="form-control" value="{{ old('available', $ticket->available) }}">
    </div>
</div>
<div class="row mb-3">
    {{-- <label for="event_id" class="col-sm-2 col-form-label">Event ID</label> --}}
    <div class="col-sm-10">
        <input type="hidden" id="event_id" name="event_id" class="form-control" value="{{$event->id}}">
    </div>
</div>
