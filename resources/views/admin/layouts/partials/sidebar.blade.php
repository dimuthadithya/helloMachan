<!-- Sidebar Start -->
<div class="sidebar">
    <nav class="bg-white navbar h-100">
        <!-- Brand -->
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-4 mb-4 text-decoration-none">
            <h3 class="mb-0 text-primary d-flex align-items-center">
                <i class="bi bi-building me-2"></i>
                <span>Hello Machan</span>
            </h3>
        </a>

        <!-- Admin Profile -->
        <div class="px-4 mb-4">
            <div class="p-3 rounded-3 bg-light">
                <div class="gap-3 d-flex align-items-center">
                    <div class="position-relative">
                        <div class="p-2 rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                            <i class="mb-0 bi bi-person text-primary h5"></i>
                        </div>
                        <div class="bottom-0 p-1 border border-white position-absolute end-0 bg-success rounded-circle"></div>
                    </div>
                    <div>
                        <h6 class="mb-1 text-dark">{{ auth()->user()->name }}</h6>
                        <span class="text-primary small fw-semibold d-flex align-items-center">
                            <i class="bi bi-shield-check me-1"></i>
                            Administrator
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="gap-1 px-4 navbar-nav w-100 d-flex flex-column">
            <!-- Main Navigation -->
            <div class="mb-3 nav-section">
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>

            <!-- Menu Management -->
            <div class="mb-3 nav-section">
                <h6 class="px-3 mb-2 text-muted text-uppercase small fw-semibold">Menu Management</h6>
                <div class="nav-item">
                    <a href="{{ route('admin.items.index') }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('admin.items.*') ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-menu-button-wide me-2"></i>
                        <span>Menu Items</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.categories.index') }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('admin.categories.*') ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-tags me-2"></i>
                        <span>Categories</span>
                    </a>
                </div>
            </div>

            <!-- Order Management -->
            <div class="mb-3 nav-section">
                <h6 class="px-3 mb-2 text-muted text-uppercase small fw-semibold">Order Management</h6>
                <div class="nav-item">
                    <a href="{{ route('admin.orders.index') }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('admin.orders.index') && !request('status') ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-receipt me-2"></i>
                        <span>All Orders</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request('status') === 'pending' ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-hourglass me-2"></i>
                        <span>Pending Orders</span>
                        @php
                        $pendingCount = \App\Models\Order::where('status', 'pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                        <span class="ms-auto badge bg-warning text-dark">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request('status') === 'processing' ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-arrow-repeat me-2"></i>
                        <span>Processing Orders</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request('status') === 'completed' ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-check2-circle me-2"></i>
                        <span>Completed Orders</span>
                    </a>
                </div>
            </div>

            <!-- Feedback Management -->
            <div class="mb-3 nav-section">
                <h6 class="px-3 mb-2 text-muted text-uppercase small fw-semibold">Feedback Management</h6>
                <div class="nav-item">
                    <a href="{{ route('admin.feedback.index') }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('admin.feedback.*') ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-chat-dots me-2"></i>
                        <span>Customer Feedback</span>
                        @php
                        $pendingFeedbackCount = \App\Models\Feedback::where('is_approved', false)->count();
                        @endphp
                        @if($pendingFeedbackCount > 0)
                        <span class="ms-auto badge bg-warning text-dark">{{ $pendingFeedbackCount }}</span>
                        @endif
                    </a>
                </div>
            </div>

            <!-- User Management -->
            <div class="mb-3 nav-section">
                <h6 class="px-3 mb-2 text-muted text-uppercase small fw-semibold">User Management</h6>
                <div class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('admin.users.index') ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-people me-2"></i>
                        <span>All Users</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.users.create') }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('admin.users.create') ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-person-plus me-2"></i>
                        <span>Add New User</span>
                    </a>
                </div>
            </div>

            <!-- Settings & Profile -->
            <div class="mb-3 nav-section">
                <h6 class="px-3 mb-2 text-muted text-uppercase small fw-semibold">Settings</h6>
                <div class="nav-item">
                    <a href="{{ route('admin.profile.edit') }}"
                        class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('admin.profile.*') ? 'active bg-primary text-white' : 'text-secondary hover-primary' }}">
                        <i class="bi bi-person-gear me-2"></i>
                        <span>Profile Settings</span>
                    </a>
                </div>
            </div>

            <!-- Logout Section -->
            <div class="mt-auto mb-4 nav-section">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-2 border nav-link w-100 rounded-3 text-secondary hover-danger d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->