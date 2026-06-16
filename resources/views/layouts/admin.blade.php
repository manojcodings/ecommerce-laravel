<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Ecommerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2d3748;
            width: 250px;
        }
        .sidebar a {
            color: #a0aec0;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all 0.3s;
        }
        .sidebar a:hover {
            background: #4a5568;
            color: #fff;
        }
        .sidebar .brand {
            color: #fff;
            font-size: 1.3rem;
            font-weight: bold;
            padding: 20px;
            border-bottom: 1px solid #4a5568;
        }
        .main-content {
            flex: 1;
            background: #f7fafc;
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            padding: 15px 25px;
            border-bottom: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <div class="brand">
                <i class="fas fa-store me-2"></i>Admin Panel
            </div>
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}">
                <i class="fas fa-tags me-2"></i>Categories
            </a>
            <a href="{{ route('admin.products.index') }}">
                <i class="fas fa-box me-2"></i>Products
            </a>
            <a href="{{ route('admin.orders.index') }}">
                <i class="fas fa-shopping-cart me-2"></i>Orders
            </a>
            <a href="{{ route('home') }}">
                <i class="fas fa-globe me-2"></i>View Site
            </a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i>Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <div class="main-content">
            <div class="topbar d-flex justify-content-between align-items-center">
                <h5 class="mb-0">@yield('title', 'Dashboard')</h5>
                <span>Welcome, {{ auth()->user()->name }}</span>
            </div>
            <div class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>