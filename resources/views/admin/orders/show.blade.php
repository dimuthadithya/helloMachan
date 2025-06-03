@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="p-4 bg-white border-4 rounded shadow-sm border-start border-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">Order Details #{{ $order->id }}</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="mb-0 breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order #{{ $order->id }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">
                                <i class="bi bi-trash me-2"></i>Delete Order
                            </button>
                        </form>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Order Information -->
        <div class="col-lg-8">
            <div class="p-4 mb-4 bg-white rounded shadow-sm">
                <h5 class="mb-4">Order Items</h5>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px">Image</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset($item->menuItem->image_path) }}"
                                        alt="{{ $item->menuItem->name }}"
                                        class="rounded"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <h6 class="mb-0">{{ $item->menuItem->name }}</h6>
                                    <small class="text-muted">{{ Str::limit($item->menuItem->description, 50) }}</small>
                                </td>
                                <td>Rs. {{ number_format($item->unit_price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rs. {{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                <td><strong>Rs. {{ number_format($order->total_amount, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Details Sidebar -->
        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="p-4 mb-4 bg-white rounded shadow-sm">
                <h5 class="mb-4">Customer Information</h5>
                <div class="mb-3">
                    <label class="text-muted small">Name</label>
                    <p class="mb-0">{{ $order->user->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="text-muted small">Email</label>
                    <p class="mb-0">{{ $order->user->email }}</p>
                </div>
                <div>
                    <label class="text-muted small">Member Since</label>
                    <p class="mb-0">{{ $order->user->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <!-- Order Status -->
            <div class="p-4 mb-4 bg-white rounded shadow-sm">
                <h5 class="mb-4">Order Status</h5>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="w-100 btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i>Update Status
                    </button>
                </form>
            </div>

            <!-- Order Timeline -->
            <div class="p-4 bg-white rounded shadow-sm">
                <h5 class="mb-4">Order Timeline</h5>
                <div class="timeline">
                    <div class="timeline-item">
                        <i class="bi bi-clock text-primary"></i>
                        <div>
                            <small class="text-muted">Created At</small>
                            <p class="mb-0">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                    @if($order->updated_at->ne($order->created_at))
                    <div class="timeline-item">
                        <i class="bi bi-arrow-clockwise text-info"></i>
                        <div>
                            <small class="text-muted">Last Updated</small>
                            <p class="mb-0">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .timeline {
        position: relative;
        padding-left: 1.5rem;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 0;
        top: 1.5rem;
        bottom: 0;
        width: 2px;
        background: var(--border-color);
    }

    .timeline-item i {
        position: absolute;
        left: -1.5rem;
        width: 2rem;
        height: 2rem;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--border-color);
    }
</style>
@endsection