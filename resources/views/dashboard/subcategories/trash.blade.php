@extends('layouts.dashboard.master')

@section('title')
    All Trashed Subcategories ({{ $subcategories_count }})
@endsection

@section('page-title-1', 'Categories')
@section('page-title-2')
    All Trashed Subcategories ({{ $subcategories_count }})
@endsection

@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            @if ($successMsg = Session::get('success'))
                <div class="alert alert-success text-center mt-3">
                    {{ $successMsg }}
                </div>
            @endif
            @if ($successMsg = Session::get('unauthorized_action_restore'))
                <div class="alert alert-danger text-center mt-3">
                    {{ $successMsg }}
                </div>
            @endif
            <table class="table datatable">
              <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Deleted At</th>
                    @if (auth()->user()->role == "admin")
                    <th>Actions</th>
                    @endif
                </tr>
              </thead>
              <tbody>
                @forelse ($subcategories as $subcategory)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subcategory->id }}</td>
                        <td>{{ $subcategory->name }}</td>
                        <td>{{ $subcategory->description == null ? '-' : Str::words($subcategory->description, 2, '...') }}</td>
                        <td>{{ $subcategory->deleted_at }}</td>
                        @if (auth()->user()->role == "admin")
                        <td>
                            <form action="{{ route('dashboard.subcategories.restore', $subcategory->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Restore</button>
                            </form>
                            <form action="{{ route('dashboard.subcategories.forceDelete', $subcategory->id) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure that you want to permanently delete the category ({{ $subcategory->name }})?');">Permanent Delete</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-info text-center">
                                There are no deleted categories.
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
