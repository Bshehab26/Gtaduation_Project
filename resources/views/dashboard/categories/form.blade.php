<div class="row mb-3">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}">
    </div>
</div>

<div class="row mb-3">
    <label for="description" class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-10">
        <input type="text" id="description" name="description" class="form-control" value="{{ old('description', $category->description) }}">
    </div>
</div>
