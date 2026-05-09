@extends('admin.layout')

@section('title', 'Dashboard')

@section('breadcrumb')
    Admin
    /
    <strong style="color:var(--text)">Dashboard</strong>
@endsection

@section('content')
<section class="stats-grid" aria-label="Prehľad štatistík">
    <article class="stat-card">
        <p class="stat-label">Produkty</p>
        <strong class="stat-value" style="color:var(--accent)">
            {{ $stats['products'] }}
        </strong>
    </article>

    <article class="stat-card">
        <p class="stat-label">Objednávky</p>
        <strong class="stat-value" style="color:var(--success)">
            {{ $stats['orders'] }}
        </strong>
    </article>

    <article class="stat-card">
        <p class="stat-label">Zákazníci</p>
        <strong class="stat-value">
            {{ $stats['users'] }}
        </strong>
    </article>
</section>

<section class="card" aria-labelledby="quick-actions-title">
    <header class="card-header">
        <h2 id="quick-actions-title" class="card-title">Rýchle akcie</h2>
    </header>

    <menu style="display:flex;gap:10px;list-style:none;padding:0;margin:0">
        <li>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Pridať produkt
            </a>
        </li>

        <li>
            <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">
                Všetky produkty
            </a>
        </li>
    </menu>
</section>
@endsection