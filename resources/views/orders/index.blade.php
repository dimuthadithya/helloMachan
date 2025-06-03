@extends('layouts.app')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 text-white mb-3 animated slideInLeft">Order History</h1>
        <nav aria-label="breadcrumb animated slideInRight">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>
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

    <div class="row">
        <div class="col-12">
            <div class="bg-white p-4 rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">My Orders</h4>
                    <a href="{{ route('menu') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Place New Order
                    </a>
                </div>

                @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    <span class="fw-medium">{{ $order->order_number }}</span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}<br>
                                    <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                </td>
                                <td>
                                    <div style="max-width: 300px;">
                                        @foreach($order->items as $item)
                                        <span class="badge bg-light text-dark mb-1">
                                            {{ $item->quantity }}x {{ $item->menuItem->name }}
                                        </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @switch($order->status)
                                    @case('pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                    @break
                                    @case('processing')
                                    <span class="badge bg-info">Processing</span>
                                    @break
                                    @case('completed')
                                    <span class="badge bg-success">Completed</span>
                                    @break
                                    @case('cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                    @break
                                    @default
                                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                    @endswitch
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('orders.show', $order) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye me-1"></i>View Details
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-bag display-4 text-secondary mb-3"></i>
                    <p class="text-secondary mb-3">You haven't placed any orders yet</p>
                    <a href="{{ route('menu') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-right me-2"></i>Browse Menu
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection