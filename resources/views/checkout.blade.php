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
                <h4 class="mb-4">Delivery Information</h4>                <form action="{{ route('checkout.store') }}" method="POST">
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

                        <div class="pt-4 mb-4 border-top"></div>

                        <!-- Payment Information -->
                        <h5 class="mb-4">Payment Information</h5>
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('card_holder_name') is-invalid @enderror"
                                        id="card_holder_name" name="card_holder_name" placeholder="Card Holder Name"
                                        value="{{ old('card_holder_name') }}" required>
                                    <label for="card_holder_name">Card Holder Name</label>
                                    @error('card_holder_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('card_number') is-invalid @enderror"
                                        id="card_number" name="card_number" placeholder="Card Number"
                                        value="{{ old('card_number') }}" required maxlength="19">
                                    <label for="card_number">Card Number</label>
                                    @error('card_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select class="form-select @error('expiration_month') is-invalid @enderror"
                                        id="expiration_month" name="expiration_month" required>
                                        <option value="">Month</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                            {{ old('expiration_month') == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                            </option>
                                            @endfor
                                    </select>
                                    <label for="expiration_month">Month</label>
                                    @error('expiration_month')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select class="form-select @error('expiration_year') is-invalid @enderror"
                                        id="expiration_year" name="expiration_year" required>
                                        <option value="">Year</option>
                                        @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                            <option value="{{ $i }}" {{ old('expiration_year') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                            </option>
                                            @endfor
                                    </select>
                                    <label for="expiration_year">Year</label>
                                    @error('expiration_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="password" class="form-control @error('cvv') is-invalid @enderror"
                                        id="cvv" name="cvv" placeholder="CVV" required
                                        maxlength="4" minlength="3">
                                    <label for="cvv">CVV</label>
                                    @error('cvv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 col-12">
                            <button type="submit" class="py-3 btn btn-primary w-100">
                                <i class="bi bi-bag-check me-2"></i>Place Order and Pay
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

        // Card number formatting        const cardInput = document.getElementById('card_number');
        cardInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(.{4})/g, '$1 ').trim();
            e.target.value = value;
        });

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