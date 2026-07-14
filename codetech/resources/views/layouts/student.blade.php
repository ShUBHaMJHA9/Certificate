<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Student Dashboard') | CodeTech Foundation</title>
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <script>
        (() => { document.documentElement.dataset.theme = localStorage.getItem('codetech-theme') || 'light'; })();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ filemtime(public_path('assets/css/style.css')) }}">
    @stack('styles')
</head>
<body class="student-body" x-data="{ mobileMenuOpen: false }">
    <header class="student-global-header">
        <div class="student-header-brand"><a href="{{ url('/') }}"><img src="{{ asset('assets/images/logo.png') }}" alt=""><span><strong>CodeTech</strong><small>Student workspace</small></span></a></div>
        <div class="student-header-actions">
            <a href="{{ route('internships.index') }}" class="student-explore-link"><i class="fas fa-compass"></i><span>Explore programs</span></a>
            <button type="button" class="admin-header-icon" id="theme-toggle" aria-label="Switch color theme"><i class="fas fa-moon"></i></button>
            <button type="button" class="student-menu-button" @click="mobileMenuOpen = true" aria-label="Open student navigation"><i class="fas fa-bars"></i></button>
        </div>
    </header>
    <main>@yield('content')</main>
    @include('partials.telegram-popup')
    <script src="{{ asset('assets/js/main.js') }}?v={{ filemtime(public_path('assets/js/main.js')) }}"></script>
    @stack('scripts')
</body>
</html>
