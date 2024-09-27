@extends('layouts.dashboard.master')

@section('title')
    All Categories ({{ $categories->count() }})
@endsection

@section('page-title-1', 'Categories')
@section('page-title-2')
    All Categories ({{ $categories->count() }})
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        {{-- limit by character --}}
                                        {{-- <td>{{ $category->description == null ? 'N/A' : Str::limit($category->description, 60, '...') }}</td> --}}
                                        {{-- limit by word --}}
                                        <td>{{ $category->description == null ? '-' : Str::words($category->description, 2, '...') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('categories.show', [$category->id,$category->name]) }}"
                                                class="btn btn-sm btn-warning">Show</a>
                                            <a href="{{ route('categories.edit',$category->id ) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
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

                     <div class="d-flex justify-content-lg-end" >
                        <form action="{{ route('categories.destroyAll')}}" method="POST"
                        style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete All</button>
                    </form>
                     </div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
