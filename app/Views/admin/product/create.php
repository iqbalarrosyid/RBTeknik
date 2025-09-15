<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produk Baru - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f8f9fa;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .fw-semibold {
            font-family: 'Montserrat', sans-serif;
        }

        .form-label {
            font-weight: 600;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }

        /* Styling untuk area preview gambar */
        #image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1rem;
        }

        .preview-thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 2px;
        }
    </style>
</head>

<body class="py-5">

    <div class="container">

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

                    <div class="mb-3">
                        <label for="images" class="form-label">Foto Produk (bisa pilih lebih dari 1)</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                        <div id="image-preview"></div>
                    </div>

                    <div class="card-footer bg-white text-end border-0 pt-4 px-0">
                        <a href="<?= base_url('admin/product'); ?>" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-dark fw-semibold">
                            <i class="bi bi-check-circle me-1"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('images').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Kosongkan preview sebelumnya

            if (this.files) {
                Array.from(this.files).forEach(file => {
                    if (!file.type.startsWith('image/')) {
                        return
                    } // Hanya proses file gambar

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('preview-thumbnail');
                        previewContainer.appendChild(img);
                    };

                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
</body>

</html>