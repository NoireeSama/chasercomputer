<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard CC+')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        @stack('css')
</head>
<body>
<div class="main-container">
    <nav class="glass-panel navbar">
        <div class="logo">Dashboard CC+</div>
        <ul class="nav-links">
            <li>
                <a href="{{ route('dashboard.admin') }}"
                   class="{{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
                   Pesanan
                </a>
            </li>
            <li>
                <a href="{{ route('persediaan') }}"
                   class="{{ request()->routeIs('persediaan') ? 'active' : '' }}">
                   Persediaan
                </a>
            </li>
            <li>
                <a href="{{ route('garansi') }}" class="{{ request()->routeIs('garansi') ? 'active' : '' }}">
                   Garansi Aktif
                </a>
            </li>
            <li>
                <a href="{{ route('staff') }}" class="{{ request()->routeIs('staff') ? 'active' : '' }}">
                   Staff
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->routeIs('user') ? 'active' : '' }}">
                   User
                </a>
            </li>
        </ul>
                <form method="POST" action="{{ route('logout') }}" class="logout-btn-wrapper">
            @csrf
            <button type="submit" class="glass-pill logout-btn" style="border:none; width: 100px; cursor: pointer;">
                Keluar
            </button>
        </form>
    </nav>
        @yield('content')
</div>
</body>
</html>
