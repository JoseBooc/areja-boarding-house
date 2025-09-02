<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dormitory Admin</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-[var(--agoda-gray)]">
<header class="agoda-header">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('users.index') }}" class="text-xl font-semibold">Dormitory Admin</a>
        <nav class="flex items-center gap-4">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="agoda-btn-accent">Logout</button>
                </form>
            @endauth
        </nav>
    </div>
</header>
<main class="max-w-6xl mx-auto px-4 py-8">
    @if (session('status'))
        <div class="agoda-card border-l-4 border-[var(--agoda-yellow)] p-4 mb-6">{{ session('status') }}</div>
    @endif
    @if ($errors->any())
        <div class="agoda-card border-l-4 border-red-500 p-4 mb-6">
            <ul class="list-disc ml-5 text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ $slot ?? '' }}
    @yield('content')
</main>
</body>
</html>
