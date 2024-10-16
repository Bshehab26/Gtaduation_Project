@extends('layouts.dashboard.master')

@section('title')
    All Subcategories ({{ $subcategories->count() }})
@endsection

@section('page-title-1', 'Subcategories')
@section('page-title-2')
    All Subcategories ({{ $subcategories->count() }})
@endsection
@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <table class="table datatable">
              <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($subcategories as $subcategory)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subcategory->id }}</td>
                        <td>{{ $subcategory->name }}</td>
                        <td>{{ $subcategory->description == null ? '-' : Str::words($subcategory->description, 2, '...') }}</td>
                        <td>{{ $subcategory->category->name }}</td>
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
            <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
