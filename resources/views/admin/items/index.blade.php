@extends('admin.layouts.app')

@section('title', 'Menu Items')

@section('content')
<div class="container-fluid">
    <div class="p-4 rounded bg-light">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Menu Items</h5>
            <a href="{{ route('admin.items.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Add New Item
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>
                            <img src="{{ $item->image ? asset('storage/'.$item->image) : asset('img/default-food.jpg') }}"
                                alt="{{ $item->name }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $item->is_available ? 'success' : 'danger' }}">
                                {{ $item->is_available ? 'Available' : 'Not Available' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.items.edit', $item) }}" class="btn btn-sm btn-primary me-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.items.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No menu items found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection