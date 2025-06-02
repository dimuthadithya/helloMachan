<!-- Sidebar Start -->
<div class="sidebar bg-dark pe-4 pb-3">
    <nav class="navbar navbar-dark">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">
                <i class="fa fa-utensils me-2"></i>Hello Machan
            </h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <i class="bi bi-person-circle h3 text-white"></i>
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white">{{ auth()->user()->name }}</h6>
                <span class="text-white-50">Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
            <a href="{{ route('admin.menu') }}" class="nav-item nav-link {{ request()->routeIs('admin.menu*') ? 'active' : '' }}">
                <i class="bi bi-menu-button-wide me-2"></i>Menu Items
            </a>
            <a href="{{ route('admin.orders') }}" class="nav-item nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <i class="bi bi-receipt me-2"></i>Orders
            </a>
            <a href="{{ route('admin.reservations') }}" class="nav-item nav-link {{ request()->routeIs('admin.reservations*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check me-2"></i>Reservations
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>Users
            </a> <a href="{{ route('admin.settings') }}" class="nav-item nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <i class="bi bi-gear me-2"></i>Settings
            </a>
            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button type="submit" class="nav-item nav-link bg-transparent border-0 w-100 text-start">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>
</div>
<!-- Sidebar End -->