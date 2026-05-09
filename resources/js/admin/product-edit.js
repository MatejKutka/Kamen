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
    const selectedSubcategory =
        subcategorySelect.dataset.selectedSubcategory || "";

    const filterSubcategories = () => {
        const categoryId = categorySelect.value;

        subcategorySelect.innerHTML = "";

        allSubOptions.forEach((option) => {
            if (option.dataset.category !== categoryId) {
                return;
            }

            const clonedOption = option.cloneNode(true);

            if (
                selectedSubcategory &&
                clonedOption.value === selectedSubcategory
            ) {
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

document.querySelectorAll(".js-delete-variant").forEach((button) => {
    button.addEventListener("click", () => {
        const formId = button.dataset.formId;
        const confirmMessage =
            button.dataset.confirmMessage || "Zmazať variant?";
        const form = document.getElementById(formId);

        if (!form) {
            return;
        }

        if (confirm(confirmMessage)) {
            form.submit();
        }
    });
});

const mainImageInput = document.getElementById("mainImageId");

document.querySelectorAll(".main-image-button").forEach((button) => {
    button.addEventListener("click", () => {
        const imageId = button.dataset.mainImageId;
        const selectedItem = document.getElementById(`img-item-${imageId}`);

        if (!mainImageInput || !selectedItem) {
            return;
        }

        mainImageInput.value = imageId;

        document.querySelectorAll(".existing-image-item").forEach((item) => {
            item.classList.remove("is-main");

            const badge = item.querySelector(".img-main-badge");
            if (badge) {
                badge.remove();
            }

            const mainButton = item.querySelector(".main-image-button");
            if (mainButton) {
                mainButton.classList.remove("is-hidden");
            }
        });

        selectedItem.classList.add("is-main");
        button.classList.add("is-hidden");

        const badge = document.createElement("strong");
        badge.className = "img-main-badge";
        badge.textContent = "Hlavný";

        selectedItem.appendChild(badge);
    });
});

document.querySelectorAll(".img-delete-toggle").forEach((button) => {
    button.addEventListener("click", () => {
        const imageId = button.dataset.deleteImageId;
        const checkbox = document.getElementById(`del-img-${imageId}`);
        const item = document.getElementById(`img-item-${imageId}`);

        if (!checkbox || !item) {
            return;
        }

        checkbox.checked = !checkbox.checked;
        item.classList.toggle("is-marked-delete", checkbox.checked);
        button.classList.toggle("is-active", checkbox.checked);
    });
});

const newVariantsContainer = document.getElementById("newVariantsContainer");
const addVariantButton = document.getElementById("addVariantBtn");

let variantIndex = 0;

if (newVariantsContainer && addVariantButton) {
    addVariantButton.addEventListener("click", () => {
        const index = variantIndex++;
        const row = document.createElement("fieldset");

        row.className = "variant-row variant-fieldset";

        row.innerHTML = `
            <p class="form-group variant-size-field">
                <label>Veľkosť</label>
                ${buildSizeField(`new_variants[${index}][size]`)}
            </p>

            <p class="form-group">
                <label>Cena (€)</label>
                <input type="number" name="new_variants[${index}][price]" step="0.01" min="0" placeholder="0.00" required>
            </p>

            <p class="form-group">
                <label>Sklad</label>
                <input type="number" name="new_variants[${index}][stock]" min="0" placeholder="0" required>
            </p>

            <footer class="variant-actions">
                <button type="button" class="btn btn-danger btn-sm remove-variant">✕</button>
            </footer>
        `;

        newVariantsContainer.appendChild(row);
    });

    newVariantsContainer.addEventListener("click", (event) => {
        if (!event.target.classList.contains("remove-variant")) {
            return;
        }

        event.target.closest(".variant-row").remove();
    });
}

const imageInput = document.getElementById("imageInput");
const previewGrid = document.getElementById("newImagePreviewGrid");
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

        item.className = "image-preview-item";

        item.innerHTML = `
            <figure class="image-preview-figure">
                <img src="${imageUrl}" alt="">
            </figure>

            <button type="button" class="img-remove" data-index="${index}">✕</button>
        `;

        item.querySelector(".img-remove").addEventListener("click", () => {
            selectedFiles.splice(index, 1);
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

if (imageInput && previewGrid && dropZone) {
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
