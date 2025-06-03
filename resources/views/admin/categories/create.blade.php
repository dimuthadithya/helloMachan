@extends('admin.layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="container-fluid">
    <div class="bg-light rounded p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Create New Category</h5>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to Categories
            </a>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">This will be displayed as the category name in menus and filters.</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">A brief description of what type of items belong in this category.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Create Category
                    </button>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Category Information</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-muted small">
                                Categories help organize menu items and make it easier for customers to find what they're looking for.
                                Choose a clear, descriptive name and add details that will help staff understand what items should be included.
                            </p>
                            <hr>
                            <div class="mb-2">
                                <i class="bi bi-info-circle me-2 text-primary"></i>
                                <small>Categories can be used to filter menu items in both admin and customer views.</small>
                            </div>
                            <div class="mb-0">
                                <i class="bi bi-exclamation-circle me-2 text-warning"></i>
                                <small>Category names must be unique.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection