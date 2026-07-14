<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') | CodeTech Foundation</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script>
        (() => {
            const saved = localStorage.getItem('codetech-theme');
            document.documentElement.dataset.theme = saved || 'light';
        })();
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
<body class="admin-body {{ request()->routeIs('admin.dashboard') ? 'admin-dashboard-page' : '' }}">
    <header class="admin-global-header">
        <div class="admin-header-left">
            <button type="button" class="admin-header-icon" data-admin-sidebar-toggle aria-label="Open admin navigation" aria-expanded="false">
                <i class="fas fa-bars"></i>
            </button>
            <div class="admin-header-title">
                <span>ADMIN WORKSPACE</span>
                <h1>@yield('title', 'Dashboard')</h1>
            </div>
        </div>
        <div class="admin-header-actions">
            <a href="{{ url('/') }}" target="_blank" class="admin-view-site"><i class="fas fa-arrow-up-right-from-square"></i><span>View website</span></a>
            <button type="button" class="admin-header-icon" id="admin-theme-toggle" aria-label="Switch color theme"><i class="fas fa-moon"></i></button>
            <div class="admin-user-chip">
                <span>{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                <div><strong>{{ auth()->user()->name ?? 'Administrator' }}</strong><small>Administrator</small></div>
            </div>
        </div>
    </header>

    <main class="admin-page-root">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('admin-overlay');
            const toggles = document.querySelectorAll('[data-admin-sidebar-toggle], #admin-sidebar-toggle');
            const closeMenu = () => {
                sidebar?.classList.remove('mobile-open');
                overlay?.classList.remove('active');
                toggles.forEach(button => button.setAttribute('aria-expanded', 'false'));
                document.body.classList.remove('admin-menu-open');
            };
            toggles.forEach(button => button.addEventListener('click', () => {
                const open = !sidebar?.classList.contains('mobile-open');
                sidebar?.classList.toggle('mobile-open', open);
                overlay?.classList.toggle('active', open);
                toggles.forEach(item => item.setAttribute('aria-expanded', String(open)));
                document.body.classList.toggle('admin-menu-open', open);
            }));
            overlay?.addEventListener('click', closeMenu);
            window.addEventListener('keydown', event => { if (event.key === 'Escape') closeMenu(); });

            const themeButton = document.getElementById('admin-theme-toggle');
            const syncTheme = () => {
                const dark = document.documentElement.dataset.theme === 'dark';
                if (themeButton) themeButton.innerHTML = `<i class="fas ${dark ? 'fa-sun' : 'fa-moon'}"></i>`;
            };
            themeButton?.addEventListener('click', () => {
                const next = document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark';
                document.documentElement.dataset.theme = next;
                localStorage.setItem('codetech-theme', next);
                syncTheme();
            });
            syncTheme();

            // ── Animate fade-up elements into view ──
            const animEls = document.querySelectorAll('.fade-up, .fade-in, .scale-in');
            if ('IntersectionObserver' in window) {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); } });
                }, { threshold: 0.08 });
                animEls.forEach(el => io.observe(el));
            } else {
                // Fallback: just show everything
                animEls.forEach(el => el.classList.add('visible'));
            }

            // ── Auto-dismiss alerts ──
            document.querySelectorAll('.auto-dismiss').forEach(el => {
                setTimeout(() => { el.style.transition = 'opacity 0.5s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 500); }, 4000);
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
