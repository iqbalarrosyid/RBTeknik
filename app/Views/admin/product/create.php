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
            <h2 class="fw-bold mb-0"><i class="bi bi-plus-circle-fill me-2"></i> Tambah Produk Baru</h2>
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

            <form action="<?= base_url('admin/product/store'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?= old('product_name'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="5"><?= old('description'); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="bahan" class="form-label">Bahan</label>
                            <input type="text" class="form-control" id="bahan" name="bahan" value="<?= old('bahan'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="warna" class="form-label">Warna</label>
                            <input type="text" class="form-control" id="warna" name="warna" value="<?= old('warna'); ?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="price" name="price" step="1000" value="<?= old('price'); ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select" id="category" name="category" required>
                                <option selected disabled value="">Pilih kategori...</option>
                                <option value="Kursi" <?= old('category') === 'Kursi' ? 'selected' : '' ?>>Kursi</option>
                                <option value="Meja" <?= old('category') === 'Meja' ? 'selected' : '' ?>>Meja</option>
                                <option value="Aksesoris" <?= old('category') === 'Aksesoris' ? 'selected' : '' ?>>Aksesoris</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dimensi (cm)</label>
                            <div class="row g-2">
                                <div class="col">
                                    <input type="number" class="form-control" name="panjang" placeholder="Panjang" value="<?= old('panjang'); ?>">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="lebar" placeholder="Lebar" value="<?= old('lebar'); ?>">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="tinggi" placeholder="Tinggi" value="<?= old('tinggi'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Foto Produk Utama -->
                <div class="mb-3">
                    <label for="images" class="form-label">Foto Produk Utama (bisa pilih lebih dari 1)</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                    <div id="image-preview" class="d-flex flex-wrap gap-2 mt-2"></div>
                </div>

                <hr class="my-4">

                <!-- Varian Produk -->
                <div class="mb-3">
                    <label class="form-label">Varian Produk</label>
                    <div id="variant-container"></div>
                    <button type="button" id="add-variant" class="btn btn-outline-dark btn-sm mt-2">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Varian
                    </button>
                </div>

                <div class="text-end">
                    <a href="<?= base_url('admin/'); ?>" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-dark fw-semibold">
                        <i class="bi bi-check-circle me-1"></i> Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script Preview & Varian -->
<script>
    // Preview gambar utama
    document.getElementById('images').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('image-preview');
        previewContainer.innerHTML = '';
        if (this.files) {
            Array.from(this.files).forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-thumbnail');
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    });

    // Tambah varian dinamis
    let variantIndex = 0;
    document.getElementById('add-variant').addEventListener('click', function() {
        const container = document.getElementById('variant-container');
        const div = document.createElement('div');
        div.classList.add('mb-3', 'border', 'p-3', 'rounded');
        div.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <strong>Varian #${variantIndex+1}</strong>
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
                <label class="form-label">Foto Varian (bisa pilih lebih dari 1)</label>
                <input type="file" class="form-control variant-images" name="variant_images[${variantIndex}][]" multiple>
                <div class="variant-preview d-flex flex-wrap gap-2 mt-2"></div>
            </div>
        `;
        container.appendChild(div);

        // Preview gambar varian
        const variantFileInput = div.querySelector('.variant-images');
        const previewDiv = div.querySelector('.variant-preview');
        variantFileInput.addEventListener('change', function() {
            previewDiv.innerHTML = '';
            Array.from(this.files).forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-thumbnail');
                    img.style.width = '80px';
                    img.style.height = '80px';
                    img.style.objectFit = 'cover';
                    previewDiv.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        });

        // Hapus varian
        div.querySelector('.remove-variant').addEventListener('click', function() {
            div.remove();
        });

        variantIndex++;
    });
</script>

<style>
    .preview-thumbnail {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 2px;
    }
</style>

<?= $this->endSection() ?>