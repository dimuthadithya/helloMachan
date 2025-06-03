@extends('layouts.app')

@section('content')
<!-- Page Header Start -->
<div class="mb-5 container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="mb-3 text-white display-3 animated slideInLeft">Shopping Cart</h1>
        <nav aria-label="breadcrumb animated slideInRight">
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('menu') }}">Menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Cart Start -->
<div class="py-5 container">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="p-4 bg-white rounded shadow-sm">
                <h4 class="mb-4">Your Cart Items</h4>

                @if($cartItems->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Storage::url($item->menuItem->image) }}" alt="{{ $item->menuItem->name }}"
                                            class="rounded" style="width: 50px; height: 50px; object-fit: cover">
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $item->menuItem->name }}</h6>
                                            <small class="text-muted">{{ Str::limit($item->menuItem->description, 50) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>${{ number_format($item->menuItem->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->menuItem->price * $item->quantity, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="3" class="text-end">Total:</td>
                                <td>${{ number_format($cartItems->sum(function($item) { 
                                    return $item->quantity * $item->menuItem->price; 
                                }), 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-end mt-4"> <a href="{{ route('menu') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                    </a>
                    <a href="{{ route('checkout.index') }}" class="ms-2 btn btn-primary">
                        <i class="bi bi-cart-check me-2"></i>Proceed to Checkout
                    </a>
                </div>
                @else
                <div class="py-5 text-center">
                    <i class="mb-3 bi bi-cart text-secondary display-4"></i>
                    <p class="mb-3 text-secondary">Your cart is empty</p>
                    <a href="{{ route('menu') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-2"></i>Browse Menu
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection