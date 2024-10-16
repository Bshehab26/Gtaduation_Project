<div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $venue->name) }}">
    </div>
</div>

<div class="row mb-3">
<label for="venue_img" class="col-sm-2 col-form-label"> Venue Image</label>
<div class="col-sm-10">
    <input type="file" id="venue_img" name="venue_img" class="form-control" value="{{ old('venue_img', $venue->venue_img) }}">
</div>
</div>

<div class="row mb-3">
    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
    <div class="col-sm-10">
        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $venue->phone) }}">
    </div>
</div>

<div class="row mb-3">
    <label for="city" class="col-sm-2 col-form-label">City</label>
    <div class="col-sm-10">
        <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $venue->city) }}">
    </div>
</div>

<div class="row mb-3">
    <label for="address" class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-10">
        <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $venue->address) }}">
    </div>
</div>



<div class="row mb-3">
    <label for="capacity" class="col-sm-2 col-form-label">capacity</label>
    <div class="col-sm-10">
        <input type="text" id="capacity" name="capacity" class="form-control" value="{{ old('capacity', $venue->capacity) }}">
    </div>
</div>

