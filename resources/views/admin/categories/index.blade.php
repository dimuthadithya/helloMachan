@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="p-4 bg-white border-4 rounded shadow-sm border-start border-success">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">Categories</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="mb-0 breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Categories</li>
                            </ol>
                        </nav>
                    </div>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Add New Category
                    </a>
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

    <!-- Categories Table -->
    <div class="row">
        <div class="col-12">
            <div class="p-4 bg-white rounded shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Menu Items</th>
                                <th>Created</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td>
                                    <h6 class="mb-0">{{ $category->name }}</h6>
                                </td>
                                <td>
                                    <p class="mb-0 text-muted">{{ Str::limit($category->description, 100) ?: 'No description' }}</p>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $category->menu_items_count }} Items
                                    </span>
                                </td>
                                <td>{{ $category->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete {{ $category->name }}?')"
                                                {{ $category->menu_items_count > 0 ? 'disabled' : '' }}
                                                title="{{ $category->menu_items_count > 0 ? 'Cannot delete category with menu items' : 'Delete category' }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-5 text-center">
                                    <i class="mb-3 bi bi-folder-x display-4 text-secondary"></i>
                                    <p class="mb-0 text-secondary">No categories found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($categories, 'links'))
                <div class="mt-4 d-flex justify-content-end">
                    {{ $categories->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection