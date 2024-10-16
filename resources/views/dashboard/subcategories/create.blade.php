@extends('layouts.dashboard.master')

@section('title')
    Create Subategory
@endsection

@section('page-title-1', 'Subcategory')
@section('page-title-2', 'Create Subcategory')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create Subcategory</h5>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($successMsg = Session::get('success'))
                <div class="alert alert-success text-center">
                    {{ $successMsg }}
                </div>
            @endif

            <!-- General Form Elements -->
            <form action="{{ route('dashboard.subcategories.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="parent-category" class="col-sm-2 col-form-label">Category:</label>
                    <div class="col-sm-10">
                        <select name="category_id" id="parent-category" class="form-control">
                            @foreach (\App\Models\Category::orderBy('name', 'asc')->get() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description" class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-10">
                        <input type="text" id="description" name="description" class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-lg-center">
                    <input class="btn btn-success" type="submit" value="Add">
                </div>
            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
