@extends('layouts.app')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 text-white mb-3 animated slideInLeft">My Addresses</h1>
        <nav aria-label="breadcrumb animated slideInRight">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Addresses</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Success Message -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Add New Address -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Add New Address</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('addresses.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="address" class="form-label">Address *</label>
                            <textarea class="form-control @error('address') is-invalid @enderror"
                                id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_default" name="is_default" value="1">
                            <label class="form-check-label" for="is_default">Set as default address</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Address</button>
                    </form>
                </div>
            </div>

            <!-- Saved Addresses -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Saved Addresses</h5>
                </div>
                <div class="card-body">
                    @if($addresses->isEmpty())
                    <p class="text-center mb-0">You haven't added any addresses yet.</p>
                    @else
                    @foreach($addresses as $address)
                    <div class="border-bottom mb-3 pb-3">
                        <form action="{{ route('addresses.update', $address) }}" method="POST" class="address-form">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label class="form-label">Address *</label>
                                <textarea class="form-control @error('address') is-invalid @enderror"
                                    name="address" rows="3" required>{{ old('address', $address->address) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone', $address->phone) }}" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" name="is_default" value="1"
                                    {{ $address->is_default ? 'checked' : '' }}>
                                <label class="form-check-label">Default address</label>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                <form action="{{ route('addresses.destroy', $address) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Are you sure you want to delete this address?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </form>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection