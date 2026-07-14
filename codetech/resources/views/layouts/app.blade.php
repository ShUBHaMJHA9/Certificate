<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    @php $siteName = \App\Models\Setting::where('key', 'site_name')->value('value') ?? 'Codetech Foundation'; @endphp

    <title>@yield('title', 'Launch Your Tech Career') | {{ $siteName }}</title>

    {{-- SEO Meta --}}
    <meta name="description" content="@yield('meta_description', 'Join Codetech Foundation for industry-leading internships, verified certifications, and hands-on project experience.')">
    <meta name="keywords" content="@yield('meta_keywords', 'internships, coding, web development, certificates, tech careers, students, training, free internship, online course')">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="@yield('title', 'Launch Your Tech Career') | {{ $siteName }}">
    <meta property="og:description" content="@yield('meta_description', 'Master real-world skills with our structured internship programs.')">
    <meta property="og:image" content="@yield('og_image', asset('assets/images/og-image.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    @stack('seo')

    {{-- Inline theme init BEFORE render to avoid flash --}}
    <script>
        (() => {
            const saved = localStorage.getItem('codetech-theme');
            const preferred = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            document.documentElement.dataset.theme = saved || preferred;
        })();
    </script>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Manrope:wght@500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">

    {{-- Alpine.js Collapse Plugin (must load before Alpine) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Tailwind compiled via Vite (production-safe) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom Design System --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ filemtime(public_path('assets/css/style.css')) }}">

    @stack('styles')
    @stack('head')
</head>

<body>

    @if(!isset($hideHeader) || !$hideHeader)
        @include('partials.header')
    @endif

    <main>
        @yield('content')
    </main>

    @if(!isset($hideFooter) || !$hideFooter)
        @include('partials.telegram-popup')
        @include('partials.footer')
    @endif

    {{-- Main Scripts --}}
    <script src="{{ asset('assets/js/main.js') }}?v={{ filemtime(public_path('assets/js/main.js')) }}"></script>

    @stack('scripts')

</body>

</html>
