@extends('admin.layouts.app')

@section('title', 'Orders')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="p-4 bg-white border-4 rounded shadow-sm border-start border-info">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">Orders</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="mb-0 breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Orders</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Stats -->
    <div class="mb-4 row g-4">
        <div class="col-12 col-md-8">
            <div class="p-4 bg-white rounded shadow-sm">
                <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-filter me-2"></i>Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="p-4 bg-white rounded shadow-sm">
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <p class="mb-0 text-secondary">Total Orders</p>
                        <h3 class="mb-0">{{ $orders->count() }}</h3>
                    </div>
                    <div>
                        <p class="mb-0 text-secondary">Today's Orders</p>
                        <h5 class="mb-0 text-info">{{ $orders->where('created_at', '>=', \Carbon\Carbon::today())->count() }}</h5>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <small class="text-success">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ $orders->where('status', 'completed')->count() }} Completed
                    </small>
                    <small class="text-warning">
                        <i class="bi bi-clock me-1"></i>
                        {{ $orders->where('status', 'pending')->count() }} Pending
                    </small>
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

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Orders Table -->
    <div class="row">
        <div class="col-12">
            <div class="p-4 bg-white rounded shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th style="width: 120px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>
                                    <strong class="text-primary">#{{ $order->id }}</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="p-2 rounded-circle bg-light">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $order->user->name }}</h6>
                                            <small class="text-muted">{{ $order->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->items->count() }} items</td>
                                <td>
                                    <h6 class="mb-0">${{ number_format($order->total, 2) }}</h6>
                                </td>
                                <td>
                                    <span class="badge bg-{{ 
                                        $order->status === 'completed' ? 'success' : 
                                        ($order->status === 'pending' ? 'warning' : 
                                        ($order->status === 'cancelled' ? 'danger' : 'info')) 
                                    }}">
                                        <i class="bi bi-{{ 
                                            $order->status === 'completed' ? 'check-circle' : 
                                            ($order->status === 'pending' ? 'hourglass' : 
                                            ($order->status === 'cancelled' ? 'x-circle' : 'arrow-repeat')) 
                                        }} me-1"></i>
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.orders.destroy', $order) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure you want to delete Order #{{ $order->id }}?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-5 text-center">
                                    <i class="mb-3 bi bi-inbox display-4 text-secondary"></i>
                                    <p class="mb-0 text-secondary">No orders found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection