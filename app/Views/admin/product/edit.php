<?= $this->extend('layout/admintemplate') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <div class="mb-4">
        <a href="<?= base_url('admin/'); ?>" class="text-decoration-none text-dark">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Produk
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header py-3">
            <h2 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Produk</h2>
        </div>
        <div class="card-body p-4">

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <p class="fw-bold mb-2">Terjadi Kesalahan:</p>
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>

            <form action="<?= base_url('admin/product/update/' . $product['id']); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="product_name" value="<?= esc($product['product_name']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="5"><?= esc($product['description']) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bahan</label>
                            <input type="text" class="form-control" name="bahan" value="<?= esc($product['bahan']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Warna</label>
                            <input type="text" class="form-control" name="warna" value="<?= esc($product['warna']) ?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" name="price" value="<?= esc($product['price']) ?>" step="1000" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="category" required>
                                <option disabled value="">Pilih kategori...</option>
                                <option value="Kursi" <?= $product['category'] === 'Kursi' ? 'selected' : '' ?>>Kursi</option>
                                <option value="Meja" <?= $product['category'] === 'Meja' ? 'selected' : '' ?>>Meja</option>
                                <option value="Aksesoris" <?= $product['category'] === 'Aksesoris' ? 'selected' : '' ?>>Aksesoris</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dimensi (cm)</label>
                            <div class="row g-2">
                                <div class="col"><input type="number" class="form-control" name="panjang" placeholder="Panjang" value="<?= esc($product['panjang']) ?>"></div>
                                <div class="col"><input type="number" class="form-control" name="lebar" placeholder="Lebar" value="<?= esc($product['lebar']) ?>"></div>
                                <div class="col"><input type="number" class="form-control" name="tinggi" placeholder="Tinggi" value="<?= esc($product['tinggi']) ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Galeri gambar lama -->
                <div class="mb-3">
                    <label class="form-label">Galeri Gambar Produk</label>
                    <div id="image-gallery" class="d-flex flex-wrap gap-2 p-2 bg-light border rounded">
                        <?php foreach ($images as $img): ?>
                            <div class="image-wrapper position-relative">
                                <img src="<?= base_url('uploads/products/' . $img['image_url']) ?>" class="preview-thumbnail">
                                <div class="delete-image-btn" data-image-id="<?= $img['id'] ?>"><i class="bi bi-x"></i></div>
                                <input type="checkbox" name="delete_images[]" value="<?= $img['id'] ?>" id="delete_<?= $img['id'] ?>" class="d-none">
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <!-- Tambah gambar baru -->
                <div class="mb-3">
                    <label class="form-label">Tambah Gambar Baru</label>
                    <input type="file" id="new_images" name="new_images[]" multiple class="form-control">
                    <div id="new-image-preview" class="d-flex flex-wrap gap-2 mt-2"></div>
                </div>

                <hr class="my-4">

                <!-- Varian produk lama -->
                <div class="mb-3">
                    <label class="form-label">Varian Produk</label>
                    <div id="variant-container"></div>
                    <button type="button" class="btn btn-outline-dark btn-sm mt-2" id="add-variant"><i class="bi bi-plus-circle me-1"></i> Tambah Varian</button>
                </div>

                <div class="text-end">
                    <a href="<?= base_url('admin/'); ?>" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-dark fw-semibold"><i class="bi bi-check-circle me-1"></i> Update Produk</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    // --- Preview gambar produk utama baru ---
    document.getElementById('new_images').addEventListener('change', function() {
        const container = document.getElementById('new-image-preview');
        container.innerHTML = '';
        Array.from(this.files).forEach(file => {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('preview-thumbnail');
                img.style.width = '70px'; // kecil seperti create
                img.style.height = '70px';
                img.style.objectFit = 'cover';
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });

    // --- Hapus gambar lama produk utama ---
    document.querySelectorAll('.delete-image-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.imageId;
            const checkbox = document.getElementById('delete_' + id);
            const img = this.previousElementSibling;
            checkbox.checked = !checkbox.checked;
            img.classList.toggle('image-marked-for-deletion');
        });
    });

    // --- Varian Produk Dinamis ---
    let variantIndex = 0;
    const variantContainer = document.getElementById('variant-container');

    // --- Render varian lama dari server ---
    const oldVariants = <?= json_encode($variants) ?>; // $variants dikirim dari controller
    oldVariants.forEach((v, i) => {
        const div = document.createElement('div');
        div.classList.add('mb-3', 'border', 'p-3', 'rounded');
        div.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <strong>Varian Lama #${i+1}</strong>
                <button type="button" class="btn btn-sm btn-danger remove-variant">Hapus</button>
            </div>
            <input type="hidden" name="variants[${variantIndex}][id]" value="${v.id}">
            <div class="mb-2">
                <label class="form-label">Nama Varian</label>
                <input type="text" class="form-control" name="variants[${variantIndex}][variant_name]" value="${v.variant_name}" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Harga Varian</label>
                <input type="number" class="form-control" name="variants[${variantIndex}][price]" value="${v.price}" step="1000" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Gambar Varian Lama</label>
                <div class="d-flex flex-wrap gap-2 mb-2">
                    ${v.images.map(img=>`
                        <div class="image-wrapper position-relative">
                            <img src="<?= base_url('uploads/products/') ?>${img.image_url}" class="preview-thumbnail" style="width:70px;height:70px;">
                            <div class="delete-image-btn" data-variant-image-id="${img.id}"><i class="bi bi-x"></i></div>
                            <input type="checkbox" name="delete_variant_images[${v.id}][]" value="${img.id}" class="d-none">
                        </div>
                    `).join('')}
                </div>
                <label class="form-label">Tambah Gambar Baru Varian</label>
                <input type="file" class="form-control variant-images" name="variant_images[${variantIndex}][]" multiple>
                <div class="variant-preview d-flex flex-wrap gap-2 mt-2"></div>
            </div>
        `;
        variantContainer.appendChild(div);

        // --- Preview gambar baru varian ---
        const fileInput = div.querySelector('.variant-images');
        const previewDiv = div.querySelector('.variant-preview');
        fileInput.addEventListener('change', function() {
            previewDiv.innerHTML = '';
            Array.from(this.files).forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-thumbnail');
                    img.style.width = '70px';
                    img.style.height = '70px';
                    img.style.objectFit = 'cover';
                    previewDiv.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });

        // --- Hapus varian lama ---
        div.querySelector('.remove-variant').addEventListener('click', function() {
            div.remove();
        });

        // --- Hapus gambar lama varian ---
        div.querySelectorAll('.delete-image-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const checkbox = this.nextElementSibling;
                const img = this.previousElementSibling;
                checkbox.checked = !checkbox.checked;
                img.classList.toggle('image-marked-for-deletion');
            });
        });

        variantIndex++;
    });

    // --- Tambah varian baru ---
    document.getElementById('add-variant').addEventListener('click', function() {
        const div = document.createElement('div');
        div.classList.add('mb-3', 'border', 'p-3', 'rounded');
        div.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <strong>Varian Baru #${variantIndex+1}</strong>
                <button type="button" class="btn btn-sm btn-danger remove-variant">Hapus</button>
            </div>
            <div class="mb-2">
                <label class="form-label">Nama Varian</label>
                <input type="text" class="form-control" name="variants[${variantIndex}][variant_name]" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Harga Varian</label>
                <input type="number" class="form-control" name="variants[${variantIndex}][price]" step="1000" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Foto Varian</label>
                <input type="file" class="form-control variant-images" name="variant_images[${variantIndex}][]" multiple>
                <div class="variant-preview d-flex flex-wrap gap-2 mt-2"></div>
            </div>
        `;
        variantContainer.appendChild(div);

        // --- Preview gambar varian baru ---
        const fileInput = div.querySelector('.variant-images');
        const previewDiv = div.querySelector('.variant-preview');
        fileInput.addEventListener('change', function() {
            previewDiv.innerHTML = '';
            Array.from(this.files).forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-thumbnail');
                    img.style.width = '70px';
                    img.style.height = '70px';
                    img.style.objectFit = 'cover';
                    previewDiv.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });

        div.querySelector('.remove-variant').addEventListener('click', function() {
            div.remove();
        });

        variantIndex++;
    });
</script>


<style>
    .preview-thumbnail {
        width: 70px;
        /* ukuran kecil sama seperti create */
        height: 70px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
        padding: 1px;
    }

    .variant-preview .preview-thumbnail {
        width: 70px;
        /* varian sedikit lebih besar */
        height: 70px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
        padding: 1px;
    }

    .image-marked-for-deletion {
        opacity: 0.5;
        border: 2px dashed #dc3545;
    }
</style>

<?= $this->endSection() ?>