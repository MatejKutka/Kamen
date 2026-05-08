@extends('admin.layout')

@section('title', 'Upraviť produkt')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a>
    <span>/</span>
    <a href="{{ route('admin.products.index') }}">Produkty</a>
    <span>/</span>
    <strong style="color:var(--text)">{{ $product->name }}</strong>
@endsection

@section('content')

{{-- Formy pre mazanie variantov sú MIMO hlavného formu --}}
@foreach($variants as $variant)
<form id="del-variant-{{ $variant->id }}" method="POST"
      action="{{ route('admin.variants.destroy', $variant->id) }}" style="display:none">
    @csrf @method('DELETE')
</form>
@endforeach

{{-- HLAVNÝ FORM --}}
<form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    {{-- ── ZÁKLADNÉ INFO ── --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Základné informácie</span>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>Názov produktu *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
                @error('name') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Šport</label>
                <input type="text" name="sport" value="{{ old('sport', $product->sport) }}">
            </div>

            <div class="form-group">
                <label>Kategória</label>
                <select name="category_id" id="category_select">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $subcategories->firstWhere('id', $product->subcategory_id)?->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Subkategória *</label>
                <select name="subcategory_id" id="subcategory_select" required>
                    @foreach($subcategories as $sub)
                        <option value="{{ $sub->id }}"
                                data-category="{{ $sub->category_id }}"
                                {{ old('subcategory_id', $product->subcategory_id) == $sub->id ? 'selected' : '' }}>
                            {{ $sub->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Pohlavie *</label>
                <select name="gender" required>
                    @foreach(['men'=>'Muži','women'=>'Ženy','unisex'=>'Unisex','kids'=>'Deti'] as $val => $label)
                        <option value="{{ $val }}" {{ old('gender', $product->gender) === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group form-full">
                <label>Popis</label>
                <textarea name="description">{{ old('description', $product->description) }}</textarea>
            </div>
        </div>
    </div>

    {{-- ── EXISTUJÚCE VARIANTY ── --}}
    <div class="card" style="margin-top:16px">
        <div class="card-header">
            <span class="card-title">Existujúce varianty</span>
        </div>

        @foreach($variants as $variant)
        <div class="variant-row" style="margin-bottom:8px">
            <div class="form-group">
                <label>Farba</label>
                <input type="text" name="variants[{{ $variant->id }}][color]" value="{{ $variant->color }}" required>
            </div>
            <div class="form-group">
                <label>Veľkosť</label>
                <input type="text" name="variants[{{ $variant->id }}][size]" value="{{ $variant->size }}" required>
            </div>
            <div class="form-group">
                <label>Cena (€)</label>
                <input type="number" name="variants[{{ $variant->id }}][price]" value="{{ $variant->price }}" step="0.01" min="0" required>
            </div>
            <div class="form-group">
                <label>Sklad (ks)</label>
                <input type="number" name="variants[{{ $variant->id }}][stock]" value="{{ $variant->stock }}" min="0" required>
            </div>
            <div style="padding-bottom:2px">
                <button type="button"
                        class="btn btn-danger btn-sm"
                        style="margin-top:22px"
                        onclick="if(confirm('Zmazať variant?')) document.getElementById('del-variant-{{ $variant->id }}').submit()">
                    ✕
                </button>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ── NOVÉ VARIANTY ── --}}
    <div class="card" style="margin-top:16px">
        <div class="card-header">
            <span class="card-title">Pridať nové varianty</span>
            <button type="button" class="btn btn-ghost btn-sm" id="addVariantBtn">+ Pridať variant</button>
        </div>
        <div id="newVariantsContainer"></div>
    </div>

    {{-- ── OBRÁZKY ── --}}
    <div class="card" style="margin-top:16px">
        <div class="card-header">
            <span class="card-title">Obrázky produktu</span>
        </div>

        @if($images->count())
        <div class="section-title" style="margin-top:0;margin-bottom:12px">Existujúce obrázky</div>
        <div class="image-preview-grid">
            @foreach($images as $img)
            <div class="image-preview-item {{ $img->is_main ? 'is-main' : '' }}" id="img-item-{{ $img->id }}">
                <img src="{{ asset($img->image_path) }}" alt="">

                @if($img->is_main)
                    <div class="img-main-badge">Hlavný</div>
                @else
                    <button type="button" class="img-remove"
                            onclick="setMain({{ $img->id }}, this)"
                            title="Nastav ako hlavný">★</button>
                @endif

                {{-- Tlačidlo zmazať --}}
                <button type="button"
                        onclick="toggleDelete({{ $img->id }}, this)"
                        style="position:absolute;bottom:4px;right:4px;background:rgba(0,0,0,.5);color:#fff;border:none;border-radius:4px;padding:2px 5px;font-size:11px;cursor:pointer;">
                    🗑
                </button>
                <input type="checkbox" name="delete_images[]" value="{{ $img->id }}"
                       id="del-img-{{ $img->id }}" style="display:none">
            </div>
            @endforeach
        </div>
        <input type="hidden" name="main_image_id" id="mainImageId"
               value="{{ $images->firstWhere('is_main', true)?->id ?? '' }}">
        @endif

        <div class="section-title">Pridať nové obrázky</div>
        <div class="image-upload-area" id="dropZone">
            <input type="file" name="new_images[]" id="imageInput" multiple accept="image/*">
            <svg viewBox="0 0 24 24" fill="none" stroke="var(--muted)" stroke-width="1.5"
                 style="width:36px;height:36px;margin-bottom:8px">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <polyline points="21 15 16 10 5 21"/>
            </svg>
            <p style="color:var(--muted);font-size:14px">
                Presuň obrázky alebo <span style="color:var(--accent)">klikni pre výber</span>
            </p>
        </div>
        <div class="image-preview-grid" id="newImagePreviewGrid"></div>
    </div>

    {{-- ── SUBMIT ── --}}
    <div style="display:flex;gap:10px;margin-top:20px;justify-content:flex-end">
        <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Zrušiť</a>
        <button type="submit" class="btn btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            Uložiť zmeny
        </button>
    </div>

</form>
@endsection

@push('scripts')
<script>
// ── Nastav hlavný obrázok ──
function setMain(id, btn) {
    document.getElementById('mainImageId').value = id;

    document.querySelectorAll('.image-preview-item').forEach(el => {
        el.classList.remove('is-main');
        const badge = el.querySelector('.img-main-badge');
        if (badge) badge.remove();
        const star = el.querySelector('.img-remove');
        if (star) star.style.display = '';
    });

    const item = document.getElementById('img-item-' + id);
    item.classList.add('is-main');
    btn.style.display = 'none';
    const badge = document.createElement('div');
    badge.className = 'img-main-badge';
    badge.textContent = 'Hlavný';
    item.appendChild(badge);
}

// ── Toggle mazanie obrázka ──
function toggleDelete(id, btn) {
    const cb = document.getElementById('del-img-' + id);
    cb.checked = !cb.checked;
    btn.style.background = cb.checked ? 'rgba(217,64,64,.85)' : 'rgba(0,0,0,.5)';
    document.getElementById('img-item-' + id).style.opacity = cb.checked ? '0.4' : '1';
}

// ── Nové varianty ──
let vi = 0;
document.getElementById('addVariantBtn').addEventListener('click', () => {
    const row = document.createElement('div');
    row.className = 'variant-row';
    row.style.marginBottom = '8px';
    row.innerHTML = `
        <div class="form-group">
            <label>Farba</label>
            <input type="text" name="new_variants[${vi}][color]" placeholder="Black" required>
        </div>
        <div class="form-group">
            <label>Veľkosť</label>
            <input type="text" name="new_variants[${vi}][size]" placeholder="M" required>
        </div>
        <div class="form-group">
            <label>Cena (€)</label>
            <input type="number" name="new_variants[${vi}][price]" step="0.01" min="0" placeholder="0.00" required>
        </div>
        <div class="form-group">
            <label>Sklad</label>
            <input type="number" name="new_variants[${vi}][stock]" min="0" placeholder="0" required>
        </div>
        <div style="padding-bottom:2px">
            <button type="button" class="btn btn-danger btn-sm remove-variant" style="margin-top:22px">✕</button>
        </div>
    `;
    document.getElementById('newVariantsContainer').appendChild(row);
    vi++;
});

document.getElementById('newVariantsContainer').addEventListener('click', e => {
    if (e.target.classList.contains('remove-variant')) {
        e.target.closest('.variant-row').remove();
    }
});

// ── Nové obrázky preview ──
const imageInput  = document.getElementById('imageInput');
const previewGrid = document.getElementById('newImagePreviewGrid');
const dropZone    = document.getElementById('dropZone');
let selectedFiles = [];

dropZone.addEventListener('click', () => imageInput.click());

dropZone.addEventListener('dragover', e => {
    e.preventDefault();
    dropZone.style.borderColor = '#999';
});

dropZone.addEventListener('dragleave', () => {
    dropZone.style.borderColor = 'var(--border)';
});

dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.style.borderColor = 'var(--border)';
    addFiles([...e.dataTransfer.files]);
});

imageInput.addEventListener('change', () => {
    addFiles([...imageInput.files]);
    imageInput.value = '';
});

function addFiles(files) {
    files.forEach(f => { if (f.type.startsWith('image/')) selectedFiles.push(f); });
    renderPreviews();
    syncFileInput();
}

function renderPreviews() {
    previewGrid.innerHTML = '';
    selectedFiles.forEach((file, i) => {
        const url  = URL.createObjectURL(file);
        const item = document.createElement('div');
        item.className = 'image-preview-item';
        item.innerHTML = `
            <img src="${url}" alt="">
            <button type="button" class="img-remove" data-i="${i}">✕</button>
        `;
        item.querySelector('.img-remove').addEventListener('click', () => {
            selectedFiles.splice(i, 1);
            renderPreviews();
            syncFileInput();
        });
        previewGrid.appendChild(item);
    });
}

function syncFileInput() {
    const dt = new DataTransfer();
    selectedFiles.forEach(f => dt.items.add(f));
    imageInput.files = dt.files;
}
</script>
@endpush