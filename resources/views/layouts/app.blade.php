<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Todo App') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: #f5f4f0; min-height: 100vh; }

        /* ── Navbar ── */
        .navbar {
            background: #fff;
            border-bottom: 0.5px solid #e5e5e5;
            padding: 0 2rem;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .brand-icon {
            width: 28px;
            height: 28px;
            background: #1D9E75;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 14px;
            font-weight: 500;
        }
        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            color: #1a1a1a;
            font-weight: 600;
        }
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .nav-user {
            font-size: 13px;
            color: #888;
        }
        .nav-user span {
            color: #1a1a1a;
            font-weight: 500;
        }
        .btn-logout {
            font-size: 13px;
            color: #A32D2D;
            background: #FCEBEB;
            border: none;
            border-radius: 6px;
            padding: 6px 14px;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
        }
        .btn-logout:hover { background: #F7C1C1; }

        /* ── Page content ── */
        .page-content { padding: 2rem 1rem; }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar">
        <a href="{{ route('tasks.index') }}" class="navbar-brand">
            <div class="brand-icon">✓</div>
            <span class="brand-name">To-Do-List</span>
        </a>

        <div class="navbar-right">
            <p class="nav-user">Hello, <span>{{ Auth::user()->name }}</span></p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Log out</button>
            </form>
        </div>
    </nav>

    {{-- Page Content --}}
    <main class="page-content">
        {{ $slot }}
    </main>

</body>
</html>