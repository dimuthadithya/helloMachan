@extends('layouts.app')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 text-white mb-3 animated slideInLeft">Checkout</h1>
        <nav aria-label="breadcrumb animated slideInRight">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('menu') }}">Menu</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Checkout Start -->
<div class="container py-5">
    <div class="row">
        <!-- Order Details -->
        <div class="col-lg-4 order-lg-2 mb-4">
            <div class="bg-white p-4 rounded shadow-sm">
                <h4 class="mb-4">Order Summary</h4>
                <div class="border-bottom pb-3">
                    @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between mb-3">
                        <span>{{ $item->quantity }}x {{ $item->menuItem->name }}</span>
                        <span>${{ number_format($item->quantity * $item->menuItem->price, 2) }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between pt-3">
                    <strong>Total Amount</strong>
                    <strong class="text-primary">${{ number_format($total, 2) }}</strong>
                </div>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="col-lg-8 order-lg-1">
            <div class="bg-white p-4 rounded shadow-sm">
                <h4 class="mb-4">Delivery Information</h4>
                
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" placeholder="Your Name" 
                                    value="{{ old('name', auth()->user()->name) }}" required>
                                <label for="name">Your Name</label>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" placeholder="Your Email" 
                                    value="{{ old('email', auth()->user()->email) }}" required>
                                <label for="email">Your Email</label>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                    id="phone" name="phone" placeholder="Phone Number" 
                                    value="{{ old('phone') }}" required>
                                <label for="phone">Phone Number</label>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                    id="address" name="address" placeholder="Delivery Address" 
                                    style="height: 100px" required>{{ old('address') }}</textarea>
                                <label for="address">Delivery Address</label>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('notes') is-invalid @enderror" 
                                    id="notes" name="notes" placeholder="Special Notes" 
                                    style="height: 100px">{{ old('notes') }}</textarea>
                                <label for="notes">Special Notes (Optional)</label>
                                @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100 py-3">
                                <i class="bi bi-bag-check me-2"></i>Place Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Checkout End -->
@endsection
