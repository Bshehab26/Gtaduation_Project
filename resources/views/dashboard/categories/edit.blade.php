@extends('layouts.dashboard.master')

@section('title')
    Edit Category ({{ $category->name }})
@endsection

@section('page-title-1', 'Categories')

@section('page-title-2')
    Edit Category
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Category ({{ $category->name }})</h5>

            <!-- General Form Elements -->
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('dashboard.categories.form')
                <div class="d-flex justify-content-lg-center">
                    <input class="btn btn-success" type="submit" value="Update">
                </div>
            </form><!-- End General Form Elements -->

          </div>
        </div>

      </div>
    </div>
  </section>
@endsection
