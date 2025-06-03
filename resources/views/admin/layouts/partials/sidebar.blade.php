<!-- Sidebar Start -->
<div class="pb-3 sidebar bg-dark pe-4">
    <nav class="navbar navbar-dark">
        <a href="{{ route('admin.dashboard') }}" class="mx-4 mb-3 navbar-brand">
            <h3 class="text-primary">
                <i class="fa fa-utensils me-2"></i>Hello Machan
            </h3>
        </a>
        <div class="mb-4 d-flex align-items-center ms-4">
            <div class="position-relative">
                <i class="text-white bi bi-person-circle h3"></i>
                <div class="bottom-0 p-1 border border-2 border-white bg-success rounded-circle position-absolute end-0"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white">{{ auth()->user()->name }}</h6>
                <span class="text-white-50">Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a> <a href="{{ route('admin.items.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.items.*') ? 'active' : '' }}">
                <i class="bi bi-menu-button-wide me-2"></i>Menu Items
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags me-2"></i>Categories
            </a>
            <a href="{{ route('admin.orders.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-receipt me-2"></i>Orders
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>Users
            </a>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button type="submit" class="bg-transparent border-0 nav-item nav-link w-100 text-start">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </button>
            </form>
        </div>
    </nav>
</div>
<!-- Sidebar End -->