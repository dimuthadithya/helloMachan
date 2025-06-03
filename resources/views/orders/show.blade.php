@extends('layouts.app')

@section('content')
<!-- Page Header Start -->
<div class="mb-5 container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="mb-3 text-white display-3 animated slideInLeft">Order Details</h1>
        <nav aria-label="breadcrumb animated slideInRight">
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('menu') }}">Menu</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order #{{ $order->order_number }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container py-5">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Order Status Banner -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="p-4 text-white rounded bg-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-white">Order #{{ $order->order_number }}</h4>
                        <p class="mb-0">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                    </div>
                    <div>
                        <span class="bg-white badge text-primary fs-5">{{ ucfirst($order->status) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Order Items -->
        <div class="mb-4 col-lg-8">
            <div class="p-4 bg-white rounded shadow-sm">
                <h4 class="mb-4">Order Items</h4>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Storage::url($item->menuItem->image) }}"
                                            alt="{{ $item->menuItem->name }}"
                                            class="rounded"
                                            style="width: 50px; height: 50px; object-fit: cover">
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $item->menuItem->name }}</h6>
                                            <small class="text-muted">{{ Str::limit($item->menuItem->description, 50) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">${{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-end">${{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total:</td>
                                <td class="text-end fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Details -->
        <div class="col-lg-4">
            <div class="p-4 mb-4 bg-white rounded shadow-sm">
                <h4 class="mb-4">Delivery Information</h4>
                <div class="mb-3">
                    <div class="mb-1 d-flex justify-content-between">
                        <span class="text-muted">Customer Name:</span>
                        <span class="fw-medium">{{ $order->customer_name }}</span>
                    </div>
                    <div class="mb-1 d-flex justify-content-between">
                        <span class="text-muted">Email Address:</span>
                        <span>{{ $order->customer_email }}</span>
                    </div>
                    <div class="mb-1 d-flex justify-content-between">
                        <span class="text-muted">Phone Number:</span>
                        <span>{{ $order->customer_phone }}</span>
                    </div>
                    <div class="pt-3 mt-3 border-top">
                        <label class="mb-2 text-muted d-block">Delivery Address:</label>
                        <p class="mb-0">{{ $order->delivery_address }}</p>
                    </div>
                </div>
                @if($order->notes)
                <div class="pt-3 mt-3 border-top">
                    <label class="mb-2 text-muted d-block">Special Notes:</label>
                    <p class="mb-0">{{ $order->notes }}</p>
                </div>
                @endif
            </div>

            <div class="p-4 bg-white rounded shadow-sm">
                <h4 class="mb-4">Need Help?</h4>
                <p class="mb-3">If you have any questions about your order, please contact us:</p>
                <a href="{{ route('contact') }}" class="btn btn-outline-primary w-100">
                    <i class="bi bi-chat-dots me-2"></i>Contact Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection