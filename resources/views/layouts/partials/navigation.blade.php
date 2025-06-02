<!-- Navbar & Hero Start -->
<div class="container-fluid p-0">
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
            </div>
            <a href="#booking" class="px-4 py-2 btn btn-primary">Book A Table</a>
        </div>
    </nav>
</div>
<!-- Navbar & Hero End -->