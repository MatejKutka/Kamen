<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – @yield('title', 'Panel')</title>

    @vite(['resources/css/admin.css'])

    @stack('styles')
</head>

<body>
<input type="checkbox" id="adminSidebarToggle" class="sidebar-checkbox">

<label for="adminSidebarToggle" class="sidebar-backdrop" aria-label="Zavrieť menu"></label>

<aside class="sidebar" id="adminSidebar" aria-label="Admin bočný panel">
    <header class="sidebar-logo">
        <strong>KAMEN <em>admin</em></strong>
    </header>

    <nav class="sidebar-nav" aria-label="Admin navigácia">
        <p class="nav-label">Hlavné</p>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>
            </svg>
            <b class="nav-link-text">Dashboard</b>
        </a>

        <p class="nav-label nav-label-spaced">Obchod</p>

        <a href="{{ route('admin.products.index') }}"
           class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 7H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"/>
                <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
            </svg>
            <b class="nav-link-text">Produkty</b>
        </a>
    </nav>

    <footer class="sidebar-footer">
        <a href="{{ route('home') }}" class="nav-link sidebar-footer-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            </svg>
            <b class="nav-link-text">Späť na web</b>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="nav-link logout-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                <b class="nav-link-text">Odhlásiť sa</b>
            </button>
        </form>
    </footer>
</aside>

<main class="main">
    <header class="topbar">
        <label
            for="adminSidebarToggle"
            class="sidebar-toggle"
            aria-label="Otvoriť alebo zbaliť bočný panel"
        >
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <line x1="4" y1="6" x2="20" y2="6"/>
                <line x1="4" y1="12" x2="20" y2="12"/>
                <line x1="4" y1="18" x2="20" y2="18"/>
            </svg>
        </label>

        <nav class="breadcrumb" aria-label="Breadcrumb">
            @yield('breadcrumb')
        </nav>
    </header>

    <section class="content">
        @if(session('success'))
            <section class="alert alert-success" role="alert">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>

                <p>{{ session('success') }}</p>
            </section>
        @endif

        @if(session('error'))
            <section class="alert alert-error" role="alert">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>

                <p>{{ session('error') }}</p>
            </section>
        @endif

        @if($errors->any())
            <section class="alert alert-error" role="alert">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </section>
        @endif

        @yield('content')
    </section>
</main>

@stack('scripts')
</body>
</html>