@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="p-4 text-white rounded bg-primary">
                <h4>Welcome back, {{ auth()->user()->name }}!</h4>
                <p class="mb-0">Here's what's happening with your restaurant today.</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="mb-4 row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="p-4 overflow-hidden bg-white rounded shadow-sm border-start border-5 border-primary position-relative">
                <div class="d-flex align-items-center">
                    <i class="bi bi-cart3 text-primary display-5"></i>
                    <div class="ms-4">
                        <p class="mb-2 text-secondary">Total Orders</p>
                        <h3 class="mb-0">{{ \App\Models\Order::count() }}</h3>
                    </div>
                </div>
                <div class="mt-3">
                    @php
                    $todayOrders = \App\Models\Order::whereDate('created_at', today())->count();
                    @endphp
                    <span class="badge bg-success">
                        <i class="bi bi-graph-up me-1"></i>
                        {{ $todayOrders }} Today
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-4 overflow-hidden bg-white rounded shadow-sm border-start border-5 border-warning position-relative">
                <div class="d-flex align-items-center">
                    <i class="bi bi-receipt text-warning display-5"></i>
                    <div class="ms-4">
                        <p class="mb-2 text-secondary">Menu Items</p>
                        <h3 class="mb-0">{{ \App\Models\MenuItem::count() }}</h3>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-warning text-dark">
                        <i class="bi bi-flag me-1"></i>
                        {{ \App\Models\MenuItem::where('is_available', false)->count() }} Unavailable
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-4 overflow-hidden bg-white rounded shadow-sm border-start border-5 border-success position-relative">
                <div class="d-flex align-items-center">
                    <i class="bi bi-tags text-success display-5"></i>
                    <div class="ms-4">
                        <p class="mb-2 text-secondary">Categories</p>
                        <h3 class="mb-0">{{ \App\Models\Category::count() }}</h3>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-success">
                        <i class="bi bi-collection me-1"></i>
                        {{ \App\Models\Category::has('menuItems')->count() }} Active
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="p-4 overflow-hidden bg-white rounded shadow-sm border-start border-5 border-info position-relative">
                <div class="d-flex align-items-center">
                    <i class="bi bi-people text-info display-5"></i>
                    <div class="ms-4">
                        <p class="mb-2 text-secondary">Total Users</p>
                        <h3 class="mb-0">{{ \App\Models\User::count() }}</h3>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-info">
                        <i class="bi bi-person-plus me-1"></i>
                        {{ \App\Models\User::whereDate('created_at', today())->count() }} New Today
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Orders -->
    <div class="row g-4">
        <!-- Quick Actions -->
        <div class="col-12 col-xl-4">
            <div class="p-4 bg-white rounded shadow-sm h-100">
                <h5 class="mb-4">Quick Actions</h5>
                <div class="gap-3 d-grid">
                    <a href="{{ route('admin.items.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Menu Item
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
                        <i class="bi bi-folder-plus me-2"></i>Create Category
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="text-white btn btn-info">
                        <i class="bi bi-person-plus me-2"></i>Add New User
                    </a>
                    <button class="btn btn-warning text-dark">
                        <i class="bi bi-file-earmark-text me-2"></i>Generate Reports
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="col-12 col-xl-8">
            <div class="p-4 bg-white rounded shadow-sm h-100">
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Orders</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Order::with('user')->latest()->take(5)->get() as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
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
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection