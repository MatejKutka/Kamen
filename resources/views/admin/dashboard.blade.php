@extends('admin.layout')

@section('title', 'Dashboard')

@section('breadcrumb')
    Admin
    <span>/</span>
    <strong style="color:var(--text)">Dashboard</strong>
@endsection

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Produkty</div>
        <div class="stat-value" style="color:var(--accent)">{{ $stats['products'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Objednávky</div>
        <div class="stat-value" style="color:var(--success)">{{ $stats['orders'] }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Zákazníci</div>
        <div class="stat-value">{{ $stats['users'] }}</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Rýchle akcie</span>
    </div>
    <div style="display:flex;gap:10px">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Pridať produkt
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">
            Všetky produkty
        </a>
    </div>
</div>
@endsection