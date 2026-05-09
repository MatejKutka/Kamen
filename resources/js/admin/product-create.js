const categorySelect = document.getElementById("category_select");
const subcategorySelect = document.getElementById("subcategory_select");

const clothesSizes = ["XS", "S", "M", "L", "XL", "XXL"];
const shoeSizes = Array.from({ length: 19 }, (_, index) => String(index + 30));

const shoeCategories = ["shoes"];
const noSizeCategories = ["accessories"];

const getSelectedCategoryName = () => {
    const selectedOption = categorySelect?.selectedOptions?.[0];

    return selectedOption
        ? selectedOption.textContent.trim().toLowerCase()
        : "";
};

const getSizeMode = () => {
    const categoryName = getSelectedCategoryName();

    if (shoeCategories.includes(categoryName)) {
        return "shoes";
    }

    if (noSizeCategories.includes(categoryName)) {
        return "none";
    }

    return "clothes";
};

const buildSizeField = (name, selectedValue = "") => {
    const mode = getSizeMode();

    if (mode === "none") {
        return `
            <input type="hidden" name="${name}" value="one-size">
            <input type="text" value="Bez veľkosti" disabled>
        `;
    }

    const sizes = mode === "shoes" ? shoeSizes : clothesSizes;
    const normalizedSelectedValue =
        selectedValue === "one-size" ? "" : selectedValue;

    let html = `<select name="${name}" required>`;
    html += `<option value="">Vyber veľkosť</option>`;

    sizes.forEach((size) => {
        html += `<option value="${size}" ${normalizedSelectedValue === size ? "selected" : ""}>${size}</option>`;
    });

    if (normalizedSelectedValue && !sizes.includes(normalizedSelectedValue)) {
        html += `<option value="${normalizedSelectedValue}" selected>${normalizedSelectedValue}</option>`;
    }

    html += `</select>`;

    return html;
};

const refreshSizeFields = () => {
    document.querySelectorAll(".variant-size-field").forEach((field) => {
        const input = field.querySelector(
            "input[name*='[size]'], select[name*='[size]']",
        );

        if (!input) {
            return;
        }

        const name = input.getAttribute("name");
        const selectedValue = input.value;

        field.innerHTML = `
            <label>Veľkosť</label>
            ${buildSizeField(name, selectedValue)}
        `;
    });
};

if (categorySelect && subcategorySelect) {
    const allSubOptions = [
        ...subcategorySelect.querySelectorAll("option[data-category]"),
    ];

    const filterSubcategories = () => {
        const categoryId = categorySelect.value;
        const selectedValue =
            subcategorySelect.dataset.selectedSubcategory || "";

        subcategorySelect.innerHTML = "";

        const blankOption = new Option("Vyber subkategóriu", "");
        subcategorySelect.add(blankOption);

        allSubOptions.forEach((option) => {
            if (option.dataset.category !== categoryId) {
                return;
            }

            const clonedOption = option.cloneNode(true);

            if (selectedValue && clonedOption.value === selectedValue) {
                clonedOption.selected = true;
            }

            subcategorySelect.add(clonedOption);
        });
    };

    categorySelect.addEventListener("change", () => {
        filterSubcategories();
        refreshSizeFields();
    });

    filterSubcategories();
    refreshSizeFields();
}

const variantsContainer = document.getElementById("variantsContainer");
const addVariantButton = document.getElementById("addVariantBtn");

let variantIndex = 1;

if (variantsContainer && addVariantButton) {
    addVariantButton.addEventListener("click", () => {
        const index = variantIndex++;
        const row = document.createElement("fieldset");

        row.className = "variant-row variant-fieldset";
        row.dataset.index = index;

        row.innerHTML = `
            <p class="form-group variant-size-field">
                <label>Veľkosť</label>
                ${buildSizeField(`variants[${index}][size]`)}
            </p>

            <p class="form-group">
                <label>Cena (€)</label>
                <input type="number" name="variants[${index}][price]" step="0.01" min="0" placeholder="0.00" required>
            </p>

            <p class="form-group">
                <label>Sklad (ks)</label>
                <input type="number" name="variants[${index}][stock]" min="0" placeholder="0" required>
            </p>

            <footer class="variant-actions">
                <button type="button" class="btn btn-danger btn-sm remove-variant">✕</button>
            </footer>
        `;

        variantsContainer.appendChild(row);
    });

    variantsContainer.addEventListener("click", (event) => {
        if (!event.target.classList.contains("remove-variant")) {
            return;
        }

        const rows = document.querySelectorAll(".variant-row");

        if (rows.length > 1) {
            event.target.closest(".variant-row").remove();
        }
    });
}

const imageInput = document.getElementById("imageInput");
const previewGrid = document.getElementById("imagePreviewGrid");
const mainIndexInput = document.getElementById("mainImageIndex");
const dropZone = document.getElementById("dropZone");

let selectedFiles = [];

const syncFileInput = () => {
    const dataTransfer = new DataTransfer();

    selectedFiles.forEach((file) => dataTransfer.items.add(file));

    imageInput.files = dataTransfer.files;
};

const renderPreviews = () => {
    previewGrid.innerHTML = "";

    selectedFiles.forEach((file, index) => {
        const imageUrl = URL.createObjectURL(file);
        const item = document.createElement("li");

        item.className = `image-preview-item ${index === Number(mainIndexInput.value) ? "is-main" : ""}`;

        item.innerHTML = `
            <img src="${imageUrl}" alt="">
            <button type="button" class="img-remove" data-index="${index}">✕</button>
            ${index === Number(mainIndexInput.value) ? '<strong class="img-main-badge">Hlavný</strong>' : ""}
        `;

        item.addEventListener("click", (event) => {
            if (event.target.classList.contains("img-remove")) {
                return;
            }

            mainIndexInput.value = index;
            renderPreviews();
            syncFileInput();
        });

        item.querySelector(".img-remove").addEventListener("click", (event) => {
            event.stopPropagation();

            selectedFiles.splice(index, 1);

            if (Number(mainIndexInput.value) >= selectedFiles.length) {
                mainIndexInput.value = 0;
            }

            renderPreviews();
            syncFileInput();
        });

        previewGrid.appendChild(item);
    });
};

const addFiles = (files) => {
    files.forEach((file) => {
        if (file.type.startsWith("image/")) {
            selectedFiles.push(file);
        }
    });

    renderPreviews();
    syncFileInput();
};

if (imageInput && previewGrid && mainIndexInput && dropZone) {
    dropZone.addEventListener("click", () => imageInput.click());

    dropZone.addEventListener("dragover", (event) => {
        event.preventDefault();
        dropZone.classList.add("is-dragging");
    });

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("is-dragging");
    });

    dropZone.addEventListener("drop", (event) => {
        event.preventDefault();
        dropZone.classList.remove("is-dragging");
        addFiles([...event.dataTransfer.files]);
    });

    imageInput.addEventListener("change", () => {
        addFiles([...imageInput.files]);
    });
}
