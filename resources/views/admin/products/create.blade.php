@extends('admin.layout')

@section('title', 'Pridať produkt')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}">Admin</a>
    <span>/</span>
    <a href="{{ route('admin.products.index') }}">Produkty</a>
    <span>/</span>
    <strong style="color:var(--text)">Nový produkt</strong>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- ── ZÁKLADNÉ INFO ── --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Základné informácie</span>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label>Názov produktu *</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="napr. Bežecká bunda Storm" required>
                @error('name') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Šport</label>
                <input type="text" name="sport" value="{{ old('sport') }}" placeholder="napr. Running, Cycling...">
            </div>

            <div class="form-group">
                <label>Kategória *</label>
                <select name="category_id" id="category_select" required>
                    <option value="">– Vyber kategóriu –</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Subkategória *</label>
                <select name="subcategory_id" id="subcategory_select" required>
                    <option value="">– Najprv vyber kategóriu –</option>
                    @foreach($subcategories as $sub)
                        <option value="{{ $sub->id }}"
                                data-category="{{ $sub->category_id }}"
                                {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>
                            {{ $sub->name }}
                        </option>
                    @endforeach
                </select>
                @error('subcategory_id') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Pohlavie *</label>
                <select name="gender" required>
                    <option value="">– Vyber –</option>
                    <option value="men"   {{ old('gender') === 'men'   ? 'selected' : '' }}>Muži</option>
                    <option value="women" {{ old('gender') === 'women' ? 'selected' : '' }}>Ženy</option>
                    <option value="unisex"{{ old('gender') === 'unisex'? 'selected' : '' }}>Unisex</option>
                    <option value="kids"  {{ old('gender') === 'kids'  ? 'selected' : '' }}>Deti</option>
                </select>
                @error('gender') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group form-full">
                <label>Popis</label>
                <textarea name="description" placeholder="Popis produktu...">{{ old('description') }}</textarea>
            </div>
        </div>
    </div>

    {{-- ── VARIANTY ── --}}
    <div class="card" style="margin-top:16px">
        <div class="card-header">
            <span class="card-title">Varianty (farba, veľkosť, cena, sklad)</span>
            <button type="button" class="btn btn-ghost btn-sm" id="addVariantBtn">+ Pridať variant</button>
        </div>

        @error('variants') <div class="alert alert-error" style="margin-bottom:12px">{{ $message }}</div> @enderror

        <div id="variantsContainer">
            <div class="variant-row" data-index="0">
                <div class="form-group">
                    <label>Farba</label>
                    <input type="text" name="variants[0][color]" placeholder="napr. Black" required>
                </div>
                <div class="form-group">
                    <label>Veľkosť</label>
                    <input type="text" name="variants[0][size]" placeholder="napr. M" required>
                </div>
                <div class="form-group">
                    <label>Cena (€)</label>
                    <input type="number" name="variants[0][price]" step="0.01" min="0" placeholder="0.00" required>
                </div>
                <div class="form-group">
                    <label>Sklad (ks)</label>
                    <input type="number" name="variants[0][stock]" min="0" placeholder="0" required>
                </div>
                <div style="padding-bottom:2px">
                    <button type="button" class="btn btn-danger btn-sm remove-variant" style="margin-top:22px">✕</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ── OBRÁZKY ── --}}
    <div class="card" style="margin-top:16px">
        <div class="card-header">
            <span class="card-title">Obrázky produktu</span>
        </div>

        <div class="image-upload-area" id="dropZone">
            <input type="file" name="images[]" id="imageInput" multiple accept="image/*">
            <svg viewBox="0 0 24 24" fill="none" stroke="var(--muted)" stroke-width="1.5"
                 style="width:40px;height:40px;margin-bottom:10px">
                <rect x="3" y="3" width="18" height="18" rx="2"/>
                <circle cx="8.5" cy="8.5" r="1.5"/>
                <polyline points="21 15 16 10 5 21"/>
            </svg>
            <p style="color:var(--muted);font-size:14px">Presuň obrázky sem alebo <span style="color:var(--accent)">klikni pre výber</span></p>
            <p style="color:var(--muted);font-size:12px;margin-top:4px">JPG, PNG, WebP – max 4 MB na obrázok</p>
        </div>

        <div class="image-preview-grid" id="imagePreviewGrid"></div>
        <input type="hidden" name="main_image_index" id="mainImageIndex" value="0">
    </div>

    {{-- ── SUBMIT ── --}}
    <div style="display:flex;gap:10px;margin-top:20px;justify-content:flex-end">
        <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Zrušiť</a>
        <button type="submit" class="btn btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
            Uložiť produkt
        </button>
    </div>

</form>
@endsection

@push('scripts')
<script>
// ── Kategória → Subkategória filter ──
const categorySelect    = document.getElementById('category_select');
const subcategorySelect = document.getElementById('subcategory_select');
const allSubOptions     = [...subcategorySelect.options];

function filterSubs() {
    const catId = categorySelect.value;
    subcategorySelect.innerHTML = '';
    const blank = new Option('– Vyber subkategóriu –', '');
    subcategorySelect.add(blank);
    allSubOptions.forEach(opt => {
        if (!catId || opt.dataset.category === catId) {
            subcategorySelect.add(opt.cloneNode(true));
        }
    });
}

categorySelect.addEventListener('change', filterSubs);
filterSubs();

// ── Dynamické varianty ──
let variantIndex = 1;

document.getElementById('addVariantBtn').addEventListener('click', () => {
    const i = variantIndex++;
    const row = document.createElement('div');
    row.className = 'variant-row';
    row.dataset.index = i;
    row.innerHTML = `
        <div class="form-group">
            <label>Farba</label>
            <input type="text" name="variants[${i}][color]" placeholder="napr. White" required>
        </div>
        <div class="form-group">
            <label>Veľkosť</label>
            <input type="text" name="variants[${i}][size]" placeholder="napr. L" required>
        </div>
        <div class="form-group">
            <label>Cena (€)</label>
            <input type="number" name="variants[${i}][price]" step="0.01" min="0" placeholder="0.00" required>
        </div>
        <div class="form-group">
            <label>Sklad (ks)</label>
            <input type="number" name="variants[${i}][stock]" min="0" placeholder="0" required>
        </div>
        <div style="padding-bottom:2px">
            <button type="button" class="btn btn-danger btn-sm remove-variant" style="margin-top:22px">✕</button>
        </div>
    `;
    document.getElementById('variantsContainer').appendChild(row);
});

document.getElementById('variantsContainer').addEventListener('click', e => {
    if (e.target.classList.contains('remove-variant')) {
        const rows = document.querySelectorAll('.variant-row');
        if (rows.length > 1) e.target.closest('.variant-row').remove();
    }
});

// ── Image upload & preview ──
const imageInput   = document.getElementById('imageInput');
const previewGrid  = document.getElementById('imagePreviewGrid');
const mainIndexInp = document.getElementById('mainImageIndex');
const dropZone     = document.getElementById('dropZone');
let selectedFiles  = [];

dropZone.addEventListener('click', () => imageInput.click());

dropZone.addEventListener('dragover', e => {
    e.preventDefault();
    dropZone.style.borderColor = 'var(--accent)';
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
    files.forEach(file => {
        if (!file.type.startsWith('image/')) return;
        selectedFiles.push(file);
    });
    renderPreviews();
    syncFileInput();
}

function renderPreviews() {
    previewGrid.innerHTML = '';
    selectedFiles.forEach((file, i) => {
        const url  = URL.createObjectURL(file);
        const item = document.createElement('div');
        item.className = 'image-preview-item' + (i === +mainIndexInp.value ? ' is-main' : '');
        item.innerHTML = `
            <img src="${url}" alt="">
            <button type="button" class="img-remove" data-i="${i}">✕</button>
            ${i === +mainIndexInp.value ? '<div class="img-main-badge">Hlavný</div>' : ''}
        `;
        item.style.cursor = 'pointer';
        item.addEventListener('click', (e) => {
            if (e.target.classList.contains('img-remove')) return;
            mainIndexInp.value = i;
            renderPreviews();
            syncFileInput();
        });
        item.querySelector('.img-remove').addEventListener('click', e => {
            e.stopPropagation();
            selectedFiles.splice(i, 1);
            if (+mainIndexInp.value >= selectedFiles.length) mainIndexInp.value = 0;
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