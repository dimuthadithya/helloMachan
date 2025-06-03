@extends('admin.layouts.app')

@section('title', 'Menu Items')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="p-4 bg-white border-4 rounded shadow-sm border-start border-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">Menu Items</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="mb-0 breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Menu Items</li>
                            </ol>
                        </nav>
                    </div>
                    <a href="{{ route('admin.items.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Item
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Stats -->
    <div class="mb-4 row g-4">
        <div class="col-12 col-md-8">
            <div class="p-4 bg-white rounded shadow-sm">
                <form action="{{ route('admin.items.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <select name="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Not Available</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-filter me-2"></i>Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="p-4 bg-white rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Items</p>
                        <h3 class="mb-0">{{ $items->count() }}</h3>
                    </div>
                    <div class="text-end">
                        <p class="mb-0 text-secondary">Available</p>
                        <h5 class="mb-0 text-success">{{ $items->where('is_available', true)->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Menu Items Table -->
    <div class="row">
        <div class="col-12">
            <div class="p-4 bg-white rounded shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px">Image</th>
                                <th>Item Details</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item->image ? asset('storage/'.$item->image) : asset('img/default-food.jpg') }}"
                                        alt="{{ $item->name }}" class="rounded shadow-sm"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                </td>
                                <td>
                                    <h6 class="mb-1">{{ $item->name }}</h6>
                                    <small class="text-muted">{{ Str::limit($item->description, 50) }}</small>
                                </td>
                                <td>
                                    <span class="text-white badge bg-info">
                                        {{ $item->category->name }}
                                    </span>
                                </td>
                                <td>
                                    <h6 class="mb-0">${{ number_format($item->price, 2) }}</h6>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $item->is_available ? 'success' : 'danger' }} bg-opacity-75">
                                        <i class="bi bi-{{ $item->is_available ? 'check-circle' : 'x-circle' }} me-1"></i>
                                        {{ $item->is_available ? 'Available' : 'Not Available' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.items.edit', $item) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.items.destroy', $item) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete {{ $item->name }}?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-5 text-center">
                                    <i class="mb-3 bi bi-inbox display-4 text-secondary"></i>
                                    <p class="mb-0 text-secondary">No menu items found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($items, 'links'))
                <div class="mt-4 d-flex justify-content-end">
                    {{ $items->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection