<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Todo App') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-light text-[#1a1a1a] antialiased">

    <!-- NAVBAR -->
    <nav class="bg-white border-b border-border h-14 flex items-center justify-between px-6">

        <a href="{{ route('tasks.index') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white text-base font-bold shadow-soft">
                ✓
            </div>
            <span class="font-display text-lg font-semibold">To-Do-List</span>
        </a>

        <div class="flex items-center gap-4">
            <span class="text-sm text-muted">
                Hello, <span class="text-[#1a1a1a] font-medium">{{ Auth::user()->name }}</span>
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-danger bg-[#FCEBEB] px-3 py-1.5 rounded-md">
                    Log out
                </button>
            </form>
        </div>

    </nav>

    <!-- PAGE -->
    <main class="flex justify-center">
        {{ $slot }}
    </main>

</body>
</html>