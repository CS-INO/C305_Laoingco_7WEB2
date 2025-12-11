<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Portfolio') }}</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen antialiased">

    {{-- Global header --}}
    @include('components.header')

    {{-- Page content --}}
    <main class="pt-24 pb-10">
        @yield('content')
    </main>

    {{-- Global footer --}}
    @include('components.footer')

</body>
</html>
