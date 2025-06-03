@extends('layouts.app')

@section('content')
<!-- Page Header Start -->
<div class="mb-5 container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="mb-3 text-white display-3 animated slideInLeft">Checkout</h1>
        <nav aria-label="breadcrumb animated slideInRight">
            <ol class="mb-0 breadcrumb">
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
        <div class="mb-4 col-lg-4 order-lg-2">
            <div class="p-4 bg-white rounded shadow-sm">
                <h4 class="mb-4">Order Summary</h4>
                <div class="pb-3 border-bottom">
                    @foreach($cartItems as $item)
                    <div class="mb-3 d-flex justify-content-between">
                        <span>{{ $item->quantity }}x {{ $item->menuItem->name }}</span>
                        <span>${{ number_format($item->quantity * $item->menuItem->price, 2) }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="pt-3 d-flex justify-content-between">
                    <strong>Total Amount</strong>
                    <strong class="text-primary">${{ number_format($total, 2) }}</strong>
                </div>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="col-lg-8 order-lg-1">
            <div class="p-4 bg-white rounded shadow-sm">
                <h4 class="mb-4">Delivery Information</h4>

                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    @if($addresses->isNotEmpty())
                    <div class="mb-4">
                        <h5>Select a Saved Address</h5>
                        @foreach($addresses as $address)
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input address-select" type="radio"
                                    name="address_id" id="address_{{ $address->id }}"
                                    value="{{ $address->id }}"
                                    {{ $address->is_default ? 'checked' : '' }}>
                                <label class="form-check-label" for="address_{{ $address->id }}">
                                    <strong>{{ $address->phone }}</strong><br>
                                    {{ $address->address }}
                                    @if($address->is_default)
                                    <span class="badge bg-primary ms-2">Default</span>
                                    @endif
                                </label>
                            </div>
                        </div>
                        @endforeach
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input address-select" type="radio"
                                    name="address_id" id="address_new" value="">
                                <label class="form-check-label" for="address_new">
                                    Use a different address
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 mb-4 border-top"></div>
                    @endif

                    <div class="row g-3" id="new-address-form" {{ $addresses->isNotEmpty() ? ' style=&#39;display: none;&#39;' : '' }}>
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
                            <button type="submit" class="py-3 btn btn-primary w-100">
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addressInputs = document.querySelectorAll('.address-select');
        const newAddressForm = document.getElementById('new-address-form');
        const addressFields = newAddressForm.querySelectorAll('input[required], textarea[required]');

        function toggleNewAddressForm() {
            const useNewAddress = document.getElementById('address_new').checked;
            newAddressForm.style.display = useNewAddress ? 'block' : 'none';

            // Toggle required attribute on new address fields
            addressFields.forEach(field => {
                field.required = useNewAddress;
            });
        }

        addressInputs.forEach(input => {
            input.addEventListener('change', toggleNewAddressForm);
        });

        // Initial state
        if (document.getElementById('address_new')) {
            toggleNewAddressForm();
        }
    });
</script>
@endpush