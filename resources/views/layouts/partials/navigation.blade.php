<!-- Navbar & Hero Start -->
<div class="p-0 container-fluid">
    <nav class="px-4 py-3 navbar navbar-expand-lg navbar-dark bg-dark position-relative px-lg-5 py-lg-0" style="background-color: var(--dark) !important; z-index: 1000;">
        <a href="{{ route('home') }}" class="p-0 navbar-brand">
            <h1 class="m-0 text-primary">
                <i class="fa fa-utensils me-3"></i>Hello Machan
            </h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="py-0 navbar-nav ms-auto pe-4">
                <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('menu') }}" class="nav-item nav-link {{ request()->routeIs('menu') ? 'active' : '' }}">Menu</a>
                <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </div> @guest
            <div class="gap-2 d-flex">
                <a href="{{ route('login') }}" class="px-3 py-2 btn btn-outline-light">Login</a>
                <a href="{{ route('register') }}" class="px-3 py-2 btn btn-primary">Register</a>
            </div>
            @else
            <div class="gap-2 d-flex align-items-center">
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 btn btn-outline-light">
                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                </a>
                @endif
                <a href="{{ route('orders.index') }}" class="px-3 py-2 btn btn-outline-light">
                    <i class="bi bi-clock-history me-1"></i>Orders
                </a>
                <a href="{{ route('cart.index') }}" class="px-3 py-2 btn btn-outline-light position-relative">
                    <i class="bi bi-cart3"></i>
                    @if(auth()->check())
                    @php
                    $cartCount = App\Models\CartItem::where('user_id', auth()->id())->sum('quantity');
                    @endphp
                    @if($cartCount > 0)
                    <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $cartCount }}
                    </span>
                    @endif @endif
                </a>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="px-3 py-2 btn btn-outline-light">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </div>
            @endguest
        </div>
    </nav>
</div>
<!-- Navbar & Hero End -->