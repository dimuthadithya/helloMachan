<!-- Sidebar Start -->
<div class="sidebar bg-dark">
    <nav class="navbar navbar-dark h-100">
        <!-- Brand -->
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand py-4 px-4 mb-3 border-bottom border-light border-opacity-10">
            <h3 class="text-primary mb-0 d-flex align-items-center">
                <i class="bi bi-shop me-2"></i>
                <span>Hello Machan</span>
            </h3>
        </a>

        <!-- Admin Profile -->
        <div class="px-4 mb-4">
            <div class="p-3 rounded-3 bg-dark bg-opacity-75 border border-light border-opacity-10">
                <div class="d-flex align-items-center gap-3">
                    <div class="position-relative">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                            <i class="bi bi-person-circle text-primary h4 mb-0"></i>
                        </div>
                        <div class="position-absolute bottom-0 end-0 p-1 bg-success rounded-circle border border-2 border-dark"></div>
                    </div>
                    <div>
                        <h6 class="mb-1 text-white">{{ auth()->user()->name }}</h6>
                        <span class="text-primary small fw-semibold">Administrator</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="navbar-nav w-100 d-flex flex-column gap-1 px-3">
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link px-3 py-3 rounded-3 {{ request()->routeIs('admin.dashboard') ? 'active bg-primary text-white' : 'text-white-50 hover-primary' }}">
                    <i class="bi bi-speedometer2 me-2"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.items.index') }}"
                    class="nav-link px-3 py-3 rounded-3 {{ request()->routeIs('admin.items.*') ? 'active bg-primary text-white' : 'text-white-50 hover-primary' }}">
                    <i class="bi bi-menu-button-wide me-2"></i>
                    <span>Menu Items</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.categories.index') }}"
                    class="nav-link px-3 py-3 rounded-3 {{ request()->routeIs('admin.categories.*') ? 'active bg-primary text-white' : 'text-white-50 hover-primary' }}">
                    <i class="bi bi-tags me-2"></i>
                    <span>Categories</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.orders.index') }}"
                    class="nav-link px-3 py-3 rounded-3 {{ request()->routeIs('admin.orders.*') ? 'active bg-primary text-white' : 'text-white-50 hover-primary' }}">
                    <i class="bi bi-receipt me-2"></i>
                    <span>Orders</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.users.index') }}"
                    class="nav-link px-3 py-3 rounded-3 {{ request()->routeIs('admin.users.*') ? 'active bg-primary text-white' : 'text-white-50 hover-primary' }}">
                    <i class="bi bi-people me-2"></i>
                    <span>Users</span>
                </a>
            </div>

            <!-- Logout Button -->
            <div class="nav-item mt-auto mb-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link w-100 px-3 py-3 rounded-3 text-white-50 border border-light border-opacity-10 hover-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</div>
<!-- Sidebar End -->