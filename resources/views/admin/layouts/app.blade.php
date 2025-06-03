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
            --primary: #0D6EFD;
            --light: #F0F5FF;
            --dark: #1C1C1C;
            --sidebar-bg: #F7F9FC;
            --success: #198754;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #0dcaf0;
            --text-primary: #0D6EFD;
            --text-secondary: #6B7280;
            --text-dark: #111827;
            --border-color: #E5E7EB;
        }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", "Liberation Sans", Arial, sans-serif;
            background: var(--light);
            color: var(--text-dark);
        }

        .sidebar {
            position: fixed;
            background: white;
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
            padding: 20px;
        }

        .hover-primary:hover {
            color: var(--primary) !important;
            background: rgba(13, 110, 253, 0.1);
        }

        .hover-danger:hover {
            color: var(--danger) !important;
            background: rgba(220, 53, 69, 0.1);
        }

        /* Updated card and button styles */
        .card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
        }

        .nav-link {
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateX(5px);
        }

        .nav-link.active {
            position: relative;
            font-weight: 500;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: -20px;
            top: 50%;
            transform: translateY(-50%);
            height: 30px;
            width: 4px;
            background: var(--primary);
            border-radius: 0 5px 5px 0;
        }

        .card {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            border: none;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn {
            padding: 0.5rem 1rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: #e99214;
            border-color: #e99214;
        }

        .stats-card {
            border-radius: 1rem;
            padding: 1.5rem;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
    <div class="p-0 position-relative d-flex justify-content-center align-items-start">
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