@extends('admin.layout')

@section('title', 'Pridať produkt')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a>
    /
    <a href="{{ route('admin.products.index') }}">Produkty</a>
    /
    <strong class="breadcrumb-current">Nový produkt</strong>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf

    <section class="card" aria-labelledby="basic-info-title">
        <header class="card-header">
            <h2 id="basic-info-title" class="card-title">Základné informácie</h2>
        </header>

        <section class="form-grid">
            <p class="form-group">
                <label>Názov produktu *</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="napr. Bežecká bunda Storm" required>
                @error('name') <small class="error-text">{{ $message }}</small> @enderror
            </p>

            <p class="form-group">
                <label>Šport</label>
                <select name="sport">
                    <option value="">– Bez športu –</option>

                    @foreach([
                        'football' => 'Football',
                        'basketball' => 'Basketball',
                        'running' => 'Running',
                        'climbing' => 'Climbing',
                        'volleyball' => 'Volleyball',
                    ] as $value => $label)
                        <option value="{{ $value }}" {{ mb_strtolower(old('sport', ''), 'UTF-8') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </p>

            <p class="form-group">
                <label>Farba *</label>
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
                        <option value="{{ $value }}" {{ old('color') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('color') <small class="error-text">{{ $message }}</small> @enderror
            </p>

            <p class="form-group">
                <label>Kategória *</label>
                <select name="category_id" id="category_select" required>
                    <option value="">Vyber kategóriu</option>

                    @foreach($categories as $cat)
                        @continue(mb_strtolower(trim($cat->name), 'UTF-8') === 'sports')

                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                    data-selected-subcategory="{{ old('subcategory_id') }}"
                    required
                >
                    <option value="">Vyber subkategóriu</option>

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
                                {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>
                            {{ $sub->name }}
                        </option>
                    @endforeach
                </select>
                @error('subcategory_id') <small class="error-text">{{ $message }}</small> @enderror
            </p>

            <p class="form-group">
                <label>Pohlavie *</label>
                <select name="gender" required>
                    <option value="">Vyber</option>
                    <option value="men" {{ old('gender') === 'men' ? 'selected' : '' }}>Muži</option>
                    <option value="women" {{ old('gender') === 'women' ? 'selected' : '' }}>Ženy</option>
                </select>
                @error('gender') <small class="error-text">{{ $message }}</small> @enderror
            </p>

            <p class="form-group form-full">
                <label>Popis</label>
                <textarea name="description" placeholder="Popis produktu...">{{ old('description') }}</textarea>
            </p>
        </section>
    </section>

    <section class="card section-gap" aria-labelledby="variants-title">
        <header class="card-header">
            <h2 id="variants-title" class="card-title">Varianty (veľkosť, cena, sklad)</h2>
            <button type="button" class="btn btn-ghost btn-sm" id="addVariantBtn">+ Pridať variant</button>
        </header>

        @error('variants')
            <p class="alert alert-error alert-spaced">{{ $message }}</p>
        @enderror

        <section id="variantsContainer">
            <fieldset class="variant-row variant-fieldset" data-index="0">
                <p class="form-group variant-size-field">
                    <label>Veľkosť</label>
                    <input type="text" name="variants[0][size]" value="{{ old('variants.0.size') }}" placeholder="napr. M" required>
                </p>

                <p class="form-group">
                    <label>Cena (€)</label>
                    <input type="number" name="variants[0][price]" value="{{ old('variants.0.price') }}" step="0.01" min="0" placeholder="0.00" required>
                </p>

                <p class="form-group">
                    <label>Sklad (ks)</label>
                    <input type="number" name="variants[0][stock]" value="{{ old('variants.0.stock') }}" min="0" placeholder="0" required>
                </p>

                <footer class="variant-actions">
                    <button type="button" class="btn btn-danger btn-sm remove-variant">✕</button>
                </footer>
            </fieldset>
        </section>
    </section>

    <section class="card section-gap" aria-labelledby="images-title">
        <header class="card-header">
            <h2 id="images-title" class="card-title">Obrázky produktu</h2>
        </header>

        <section class="image-upload-area" id="dropZone" aria-label="Nahranie obrázkov produktu">
            <input type="file" name="images[]" id="imageInput" multiple accept="image/*">

            <svg class="upload-icon" viewBox="0 0 24 24" fill="none" stroke="#888888" stroke-width="1.5">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <polyline points="21 15 16 10 5 21"/>
            </svg>

            <p class="upload-text">
                Presuň obrázky sem alebo <strong class="upload-link">klikni pre výber</strong>
            </p>

            <p class="upload-hint">
                JPG, PNG, WebP max 4 MB na obrázok
            </p>
        </section>

        <ul class="image-preview-grid" id="imagePreviewGrid" role="list"></ul>
        <input type="hidden" name="main_image_index" id="mainImageIndex" value="0">
    </section>

    <footer class="form-actions">
        <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Zrušiť</a>

        <button type="submit" class="btn btn-primary">
            <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            Uložiť produkt
        </button>
    </footer>
</form>
@endsection

@push('scripts')
    @vite(['resources/js/admin/product-create.js'])
@endpush