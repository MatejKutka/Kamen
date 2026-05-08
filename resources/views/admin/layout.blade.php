<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – @yield('title', 'Panel')</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-w: 240px;
            --bg:        #f5f5f5;
            --sidebar:   #ffffff;
            --border:    #e8e8e8;
            --accent:    #222222;
            --danger:    #d94040;
            --success:   #2a9d6f;
            --text:      #111111;
            --muted:     #888888;
            --card:      #ffffff;
            --input-bg:  #fafafa;
            --radius:    6px;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
        }

        .sidebar-logo {
            padding: 22px 20px 18px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-logo span {
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--text);
        }

        .sidebar-logo span em {
            font-style: normal;
            font-weight: 400;
            color: var(--muted);
        }

        .sidebar-nav { padding: 14px 10px; flex: 1; }

        .nav-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #bbb;
            padding: 8px 10px 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 10px;
            border-radius: var(--radius);
            color: var(--muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background .12s, color .12s;
            margin-bottom: 1px;
        }

        .nav-link:hover  { background: #f0f0f0; color: var(--text); }
        .nav-link.active { background: #f0f0f0; color: var(--text); font-weight: 600; }
        .nav-link svg    { width: 15px; height: 15px; flex-shrink: 0; }

        .sidebar-footer {
            padding: 12px 10px;
            border-top: 1px solid var(--border);
        }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: 52px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 28px;
            background: #fff;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .breadcrumb {
            font-size: 14px;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .breadcrumb a { color: var(--muted); text-decoration: none; }
        .breadcrumb a:hover { color: var(--text); }
        .breadcrumb strong { color: var(--text); font-weight: 600; }
        .breadcrumb span { color: #ccc; }

        .content { padding: 28px; flex: 1; max-width: 1200px; }

        /* ── ALERTS ── */
        .alert {
            padding: 11px 16px;
            border-radius: var(--radius);
            margin-bottom: 18px;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .alert-success { background: #f0faf5; border: 1px solid #b6e8d0; color: var(--success); }
        .alert-error   { background: #fff5f5; border: 1px solid #f5c0c0; color: var(--danger); }

        /* ── CARDS ── */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 22px 24px;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .card-title { font-size: 14px; font-weight: 700; color: var(--text); }

        /* ── BUTTONS ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: var(--radius);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: opacity .12s, transform .1s;
            white-space: nowrap;
        }

        .btn:active { transform: scale(.97); }
        .btn:hover  { opacity: .82; }

        .btn-primary { background: var(--text); color: #fff; }
        .btn-danger  { background: var(--danger); color: #fff; }
        .btn-ghost   { background: #f0f0f0; color: var(--text); border: 1px solid var(--border); }
        .btn-sm      { padding: 5px 10px; font-size: 12px; }

        /* ── TABLE ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 14px; }

        th {
            text-align: left;
            padding: 9px 14px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .4px;
            text-transform: uppercase;
            color: var(--muted);
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 11px 14px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafafa; }

        /* ── FORM ── */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-full  { grid-column: 1 / -1; }
        .form-group { display: flex; flex-direction: column; gap: 5px; }

        label {
            font-size: 12px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            padding: 8px 11px;
            font-size: 14px;
            outline: none;
            transition: border-color .15s;
            width: 100%;
        }

        input:focus, select:focus, textarea:focus { border-color: #aaa; }
        textarea { resize: vertical; min-height: 100px; }
        .error-text { color: var(--danger); font-size: 12px; }

        /* ── VARIANTS ── */
        .variant-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 10px;
            align-items: end;
            padding: 12px;
            background: #fafafa;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            margin-bottom: 8px;
        }

        /* ── IMAGE UPLOAD ── */
        .image-upload-area {
            border: 2px dashed var(--border);
            border-radius: 8px;
            padding: 28px;
            text-align: center;
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }

        .image-upload-area:hover { border-color: #999; background: #fafafa; }
        .image-upload-area input[type="file"] { display: none; }

        .image-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 10px;
            margin-top: 12px;
        }

        .image-preview-item {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            border: 2px solid var(--border);
            aspect-ratio: 1;
        }

        .image-preview-item img { width: 100%; height: 100%; object-fit: cover; }

        .image-preview-item .img-remove {
            position: absolute;
            top: 4px; right: 4px;
            background: rgba(0,0,0,.45);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 20px; height: 20px;
            font-size: 11px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-preview-item.is-main { border-color: #111; }

        .image-preview-item .img-main-badge {
            position: absolute;
            bottom: 4px; left: 4px;
            background: #111;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .5px;
            text-transform: uppercase;
            padding: 2px 5px;
            border-radius: 3px;
        }

        /* ── BADGE ── */
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-gray  { background: #f0f0f0; color: #555; }
        .badge-green { background: #edfaf4; color: var(--success); }
        .badge-red   { background: #fff0f0; color: var(--danger); }

        .section-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .5px;
            margin: 24px 0 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border);
        }

        /* ── STATS ── */
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 20px; }

        .stat-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 18px 22px;
        }

        .stat-label { font-size: 11px; color: var(--muted); font-weight: 700; text-transform: uppercase; letter-spacing: .5px; margin-bottom: 6px; }
        .stat-value { font-size: 30px; font-weight: 800; color: var(--text); }
    </style>
    @stack('styles')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <span>KAMEN <em>admin</em></span>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-label">Hlavné</div>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
            </svg>
            Dashboard
        </a>

        <div class="nav-label" style="margin-top:10px">Obchod</div>
        <a href="{{ route('admin.products.index') }}"
           class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 7H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"/>
                <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
            </svg>
            Produkty
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('home') }}" class="nav-link" style="margin-bottom:2px">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
            </svg>
            Späť na web
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    style="width:100%;background:none;border:none;padding:0;cursor:pointer;text-align:left;">
                <div class="nav-link"
                     onclick="this.closest('form').submit()"
                     onmouseover="this.style.background='#fff0f0';this.style.color='#d94040'"
                     onmouseout="this.style.background='';this.style.color=''">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Odhlásiť sa
                </div>
            </button>
        </form>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <div class="breadcrumb">@yield('breadcrumb')</div>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:15px;height:15px;flex-shrink:0;margin-top:1px">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;flex-shrink:0;margin-top:1px">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;flex-shrink:0;margin-top:1px">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>