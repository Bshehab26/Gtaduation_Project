@extends('layouts.dashboard.master')

@section('title')
 you show ({{$category->name}})
@endsection

@section('page-title-1', 'categories')

@section('page-title-2')
Category ({{$category->name}})
@endsection

@section('content')
<nav>
    <a href="{{route('categories.index')}}">All categories</a>
</nav><br>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-4">

                    <div class="p-4 container">
                        <div class="row my-4">
                            <h5 class="col-3">Name:</h5>
                            <p class="col-9 my-auto">{{ $category->name }}</p>
                        </div>
                        <div class="row my-4">
                            <h5 class="col-3">Description:</h5>
                            <div class="col-9 my-auto" style="text-align: justify;">
                                <p>{!! $category->description !!}</p>
                            </div>
                        </div>
                        <div class="row my-4">
                            <h5 class="col-3">Subcategories:</h5>
                            <div class="col-9">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($category->subcategories as $subcategory)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $subcategory->id }}</td>
                                                <td>{{ $subcategory->name }}</td>
                                                <td>{{ $subcategory->description == null ? '-' : Str::words($subcategory->description, 2, '...') }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.subcategories.show', [$subcategory->name]) }}" class="btn btn-sm btn-warning">Show</a>
                                                    @if(auth()->user()->role == "admin")
                                                    <a href="{{ route('dashboard.subcategories.edit', $subcategory->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ route('dashboard.subcategories.destroy', $subcategory->id) }}" method="POST" style="display: inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure that you want to delete the category ({{ $subcategory->name }})?');">Delete</button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <div class="alert alert-info text-center">
                                                        No categories found.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
