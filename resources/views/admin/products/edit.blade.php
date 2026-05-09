@extends('admin.layout')

@section('title', 'Upraviť produkt')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a>
    /
    <a href="{{ route('admin.products.index') }}">Produkty</a>
    /
    <strong class="breadcrumb-current">{{ $product->name }}</strong>
@endsection

@section('content')

@foreach($variants as $variant)
<form id="del-variant-{{ $variant->id }}" method="POST"
      action="{{ route('admin.variants.destroy', $variant->id) }}" hidden>
    @csrf
    @method('DELETE')
</form>
@endforeach

<form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="hidden" name="old_color" value="{{ $color ?? '' }}">

    <section class="card" aria-labelledby="basic-info-title">
        <header class="card-header">
            <h2 id="basic-info-title" class="card-title">Základné informácie</h2>
        </header>

        <section class="form-grid">
            <p class="form-group">
                <label>Názov produktu *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name') <small class="error-text">{{ $message }}</small> @enderror
            </p>

            <p class="form-group">
                <label>Šport</label>

                @php
                    $selectedSport = mb_strtolower(old('sport', $product->sport ?? ''), 'UTF-8');
                @endphp

                <select name="sport">
                    <option value="">– Bez športu –</option>

                    @foreach([
                        'football' => 'Football',
                        'basketball' => 'Basketball',
                        'running' => 'Running',
                        'climbing' => 'Climbing',
                        'volleyball' => 'Volleyball',
                    ] as $value => $label)
                        <option value="{{ $value }}" {{ $selectedSport === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </p>

            <p class="form-group">
                <label>Farba *</label>

                @php
                    $selectedColor = mb_strtolower(old('color', $color ?? ''), 'UTF-8');
                @endphp

                <select name="color" required>
                    <option value="">Vyber farbu</option>

                    @foreach([
                       'black' => 'Black',
                        'white' => 'White',
                        'blue' => 'Blue',
                        'red' => 'Red',
                        'green' => 'Green',
                        'yellow' => 'Yellow',
                        'brown' => 'Brown',
                        'pink' => 'Pink',
                    ] as $value => $label)
                        <option value="{{ $value }}" {{ $selectedColor === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                @error('color') <small class="error-text">{{ $message }}</small> @enderror
            </p>

            <p class="form-group">
                <label>Kategória</label>

                <select name="category_id" id="category_select">
                    @foreach($categories as $cat)
                        @continue(mb_strtolower(trim($cat->name), 'UTF-8') === 'sports')

                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $subcategories->firstWhere('id', $product->subcategory_id)?->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </p>

            <p class="form-group">
                <label>Subkategória *</label>

                <select
                    name="subcategory_id"
                    id="subcategory_select"
                    data-selected-subcategory="{{ old('subcategory_id', $product->subcategory_id) }}"
                    required
                >
                    @foreach($subcategories as $sub)
                        @continue(in_array(mb_strtolower(trim($sub->name), 'UTF-8'), [
                            'climbing',
                            'running',
                            'football',
                            'basketball',
                            'volleyball',
                        ]))

                        <option value="{{ $sub->id }}"
                                data-category="{{ $sub->category_id }}"
                                {{ old('subcategory_id', $product->subcategory_id) == $sub->id ? 'selected' : '' }}>
                            {{ $sub->name }}
                        </option>
                    @endforeach
                </select>

                @error('subcategory_id') <small class="error-text">{{ $message }}</small> @enderror
            </p>

            <p class="form-group">
                <label>Pohlavie *</label>

                <select name="gender" required>
                    @foreach(['men' => 'Muži', 'women' => 'Ženy'] as $val => $label)
                        <option value="{{ $val }}" {{ old('gender', $product->gender) === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                @error('gender') <small class="error-text">{{ $message }}</small> @enderror
            </p>

            <p class="form-group form-full">
                <label>Popis</label>
                <textarea name="description">{{ old('description', $product->description) }}</textarea>
            </p>
        </section>
    </section>

    <section class="card section-gap" aria-labelledby="existing-variants-title">
        <header class="card-header">
            <h2 id="existing-variants-title" class="card-title">Existujúce varianty</h2>
        </header>

        <section>
            @foreach($variants as $variant)
                <fieldset class="variant-row variant-fieldset">
                    <p class="form-group variant-size-field">
                        <label>Veľkosť</label>
                        <input type="text" name="variants[{{ $variant->id }}][size]" value="{{ $variant->size }}" required>
                    </p>

                    <p class="form-group">
                        <label>Cena (€)</label>
                        <input type="number" name="variants[{{ $variant->id }}][price]" value="{{ $variant->price }}" step="0.01" min="0" required>
                    </p>

                    <p class="form-group">
                        <label>Sklad (ks)</label>
                        <input type="number" name="variants[{{ $variant->id }}][stock]" value="{{ $variant->stock }}" min="0" required>
                    </p>

                    <footer class="variant-actions">
                        <button
                            type="button"
                            class="btn btn-danger btn-sm js-delete-variant"
                            data-form-id="del-variant-{{ $variant->id }}"
                            data-confirm-message="Zmazať variant?"
                        >
                            ✕
                        </button>
                    </footer>
                </fieldset>
            @endforeach
        </section>
    </section>

    <section class="card section-gap" aria-labelledby="new-variants-title">
        <header class="card-header">
            <h2 id="new-variants-title" class="card-title">Pridať nové varianty</h2>
            <button type="button" class="btn btn-ghost btn-sm" id="addVariantBtn">+ Pridať variant</button>
        </header>

        <section id="newVariantsContainer"></section>
    </section>

    <section class="card section-gap" aria-labelledby="images-title">
        <header class="card-header">
            <h2 id="images-title" class="card-title">Obrázky produktu</h2>
        </header>

        @if($images->count())
            <h3 class="section-title section-title-compact">Existujúce obrázky</h3>

            <ul class="image-preview-grid image-list-reset" role="list">
                @foreach($images as $img)
                    <li class="image-preview-item existing-image-item {{ $img->is_main ? 'is-main' : '' }}" id="img-item-{{ $img->id }}">
                        <figure class="image-preview-figure">
                            <img src="{{ asset($img->image_path) }}" alt="{{ $product->name }}">
                        </figure>

                        <button
                            type="button"
                            class="img-remove main-image-button {{ $img->is_main ? 'is-hidden' : '' }}"
                            data-main-image-id="{{ $img->id }}"
                            title="Nastav ako hlavný"
                        >
                            ★
                        </button>

                        @if($img->is_main)
                            <strong class="img-main-badge">Hlavný</strong>
                        @endif

                        <button
                            type="button"
                            class="img-delete-toggle"
                            data-delete-image-id="{{ $img->id }}"
                            aria-label="Označiť obrázok na zmazanie"
                        >
                            🗑
                        </button>

                        <input
                            type="checkbox"
                            name="delete_images[]"
                            value="{{ $img->id }}"
                            id="del-img-{{ $img->id }}"
                            hidden
                        >
                    </li>
                @endforeach
            </ul>

            <input
                type="hidden"
                name="main_image_id"
                id="mainImageId"
                value="{{ $images->firstWhere('is_main', true)?->id ?? '' }}"
            >
        @endif

        <h3 class="section-title">Pridať nové obrázky</h3>

        <section class="image-upload-area" id="dropZone" aria-label="Nahranie nových obrázkov produktu">
            <input type="file" name="new_images[]" id="imageInput" multiple accept="image/*">

            <svg class="upload-icon upload-icon-small" viewBox="0 0 24 24" fill="none" stroke="#888888" stroke-width="1.5">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <polyline points="21 15 16 10 5 21"/>
            </svg>

            <p class="upload-text">
                Presuň obrázky alebo <strong class="upload-link">klikni pre výber</strong>
            </p>
        </section>

        <ul class="image-preview-grid image-list-reset" id="newImagePreviewGrid" role="list"></ul>
    </section>

    <footer class="form-actions">
        <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Zrušiť</a>

        <button type="submit" class="btn btn-primary">
            <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            Uložiť zmeny
        </button>
    </footer>
</form>
@endsection

@push('scripts')
    @vite(['resources/js/admin/product-edit.js'])
@endpush