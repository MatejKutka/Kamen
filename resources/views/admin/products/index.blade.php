@extends('admin.layout')

@section('title', 'Produkty')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a>
    <span>/</span>
    <strong style="color:var(--text)">Produkty</strong>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">Zoznam produktov ({{ count($products) }})</span>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Pridať produkt
        </a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:50px">#</th>
                    <th style="width:60px">Foto</th>
                    <th>Názov</th>
                    <th>Kategória</th>
                    <th>Pohlavie</th>
                    <th>Šport</th>
                    <th>Pridané</th>
                    <th style="width:120px">Akcie</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td style="color:var(--muted)">{{ $product->id }}</td>
                    <td>
                        @if($product->image_path)
                            <img src="{{ $product->image_path ? asset($product->image_path) : '' }}"
                                 style="width:40px;height:40px;object-fit:cover;border-radius:6px;border:1px solid var(--border)">
                        @else
                            <div style="width:40px;height:40px;border-radius:6px;background:var(--border);display:flex;align-items:center;justify-content:center">
                                <svg viewBox="0 0 24 24" fill="none" stroke="var(--muted)" stroke-width="1.5" style="width:18px;height:18px">
                                    <rect x="3" y="3" width="18" height="18" rx="2"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <polyline points="21 15 16 10 5 21"/>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td style="font-weight:600">{{ $product->name }}</td>
                    <td>
                        <span class="badge badge-blue">{{ $product->category_name }}</span>
                        <span style="color:var(--muted);font-size:12px;margin-left:4px">{{ $product->subcategory_name }}</span>
                    </td>
                    <td>{{ ucfirst($product->gender) }}</td>
                    <td>{{ $product->sport ?? '–' }}</td>
                    <td style="color:var(--muted);font-size:12px">
                        {{ \Carbon\Carbon::parse($product->created_at)->format('d.m.Y') }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-ghost btn-sm">Upraviť</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                                  onsubmit="return confirm('Naozaj zmazať produkt {{ addslashes($product->name) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Zmazať</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align:center;color:var(--muted);padding:40px">
                        Žiadne produkty. <a href="{{ route('admin.products.create') }}" style="color:var(--accent)">Pridaj prvý</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection