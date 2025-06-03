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
            width: 280px;
            z-index: 999;
            transition: all 0.3s ease;
        }

        .content {
            margin-left: 280px;
            min-height: 100vh;
            background: var(--light);
            transition: all 0.3s ease;
        }

        .hover-primary:hover {
            color: var(--primary) !important;
            background: rgba(254, 161, 22, 0.1);
        }

        .hover-danger:hover {
            color: #dc3545 !important;
            background: rgba(220, 53, 69, 0.1);
        }

        /* Fixes for mobile responsiveness */
        @media (max-width: 992px) {
            .sidebar {
                margin-left: -280px;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .content {
                margin-left: 0;
            }

            .content.active {
                margin-left: 280px;
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