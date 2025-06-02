<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Hello Machan</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary: #FEA116;
            --light: #F1F8FF;
            --dark: #0F172B;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px;
            z-index: 999;
        }

        .content {
            margin-left: 250px;
            min-height: 100vh;
            background: var(--light);
            transition: 0.5s;
        }

        .sidebar .navbar .navbar-nav .nav-link {
            padding: 7px 20px;
            color: var(--light);
            font-weight: 500;
            border-left: 3px solid var(--dark);
            border-radius: 0;
            outline: none;
        }

        .sidebar .navbar .navbar-nav .nav-link:hover,
        .sidebar .navbar .navbar-nav .nav-link.active {
            color: var(--primary);
            background: var(--dark);
            border-color: var(--primary);
        }

        @media (max-width: 992px) {
            .sidebar {
                margin-left: -250px;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    <div class="p-0 position-relative d-flex">
        @include('admin.layouts.partials.sidebar')

        <!-- Content Start -->
        <div class="content">
            <div class="p-4 container-fluid">
                @yield('content')
            </div>
            @include('admin.layouts.partials.footer')
        </div>
        <!-- Content End -->
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>