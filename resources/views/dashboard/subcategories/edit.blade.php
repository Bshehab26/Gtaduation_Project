@extends('layouts.dashboard.master')
@section('title')
    Edit subcategory ({{ $subcategory->name }})
@endsection

@section('page-title-1', 'Subcategories')

@section('page-title-2')
    Edit subcategory
@endsection

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit subcategory ({{ $subcategory->name }})</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
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
                        <form action="{{ route('dashboard.subcategories.update', $subcategory->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="parent-category" class="col-sm-2 col-form-label">Category:</label>
                                <div class="col-sm-10">
                                    <select name="category_id" id="parent-category" class="form-select">
                                        @foreach (\App\Models\Category::orderBy('name', 'asc')->get() as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $subcategory->name }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Description:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="description" name="description" class="form-control" value="{{ $subcategory->description }}">
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
