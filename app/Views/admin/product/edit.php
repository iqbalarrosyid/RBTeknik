<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Produk: <?= esc($product['product_name']) ?> - Admin Panel</title>

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

        /* Styling untuk galeri foto */
        #image-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .image-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .preview-thumbnail {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 2px;
        }

        .delete-image-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 28px;
            height: 28px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            border: 2px solid white;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .image-marked-for-deletion {
            opacity: 0.5;
            border: 2px dashed #dc3545;
        }
    </style>
</head>

<body class="py-5">

    <div class="container">

        <div class="mb-4">
            <a href="<?= base_url('admin/product'); ?>" class="text-decoration-none text-dark">
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
                                <label for="product_name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    value="<?= esc($product['product_name']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="5"><?= esc($product['description']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="bahan" class="form-label">Bahan</label>
                                <input type="text" class="form-control" id="bahan" name="bahan"
                                    value="<?= esc($product['bahan']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="warna" class="form-label">Warna</label>
                                <input type="text" class="form-control" id="warna" name="warna"
                                    value="<?= esc($product['warna']) ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="<?= esc($product['price']) ?>" step="1000" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select class="form-select" id="category" name="category" required>
                                    <option disabled value="">Pilih kategori...</option>
                                    <option value="Kursi" <?= $product['category'] === 'Kursi' ? 'selected' : '' ?>>Kursi</option>
                                    <option value="Meja" <?= $product['category'] === 'Meja' ? 'selected' : '' ?>>Meja</option>
                                    <option value="Aksesoris" <?= $product['category'] === 'Aksesoris' ? 'selected' : '' ?>>Aksesoris</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dimensi (cm)</label>
                                <div class="row g-2">
                                    <div class="col">
                                        <input type="number" class="form-control" name="panjang" placeholder="Panjang"
                                            value="<?= esc($product['panjang']) ?>">
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="lebar" placeholder="Lebar"
                                            value="<?= esc($product['lebar']) ?>">
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="tinggi" placeholder="Tinggi"
                                            value="<?= esc($product['tinggi']) ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <hr class="my-4">

                    <div class="mb-3">
                        <label class="form-label">Galeri Foto</label>
                        <div id="image-gallery" class="p-2 bg-light border rounded">
                            <?php foreach ($images as $img): ?>
                                <div class="image-wrapper">
                                    <img src="<?= base_url('uploads/products/' . $img['image_url']) ?>" class="preview-thumbnail">
                                    <div class="delete-image-btn" data-image-id="<?= $img['id'] ?>" title="Hapus Gambar Ini">
                                        <i class="bi bi-x"></i>
                                    </div>
                                    <input type="checkbox" name="delete_images[]" value="<?= $img['id'] ?>" id="delete_<?= $img['id'] ?>" class="d-none">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="new_images" class="form-label">Tambah Foto Baru (opsional)</label>
                        <input type="file" class="form-control" id="new_images" name="images[]" multiple>
                        <div id="new-image-preview" class="d-flex flex-wrap gap-3 mt-3"></div>
                    </div>

                    <div class="card-footer bg-white text-end border-0 pt-4 px-0">
                        <a href="<?= base_url('admin/'); ?>" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-dark fw-semibold">
                            <i class="bi bi-check-circle me-1"></i> Update Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // --- SCRIPT UNTUK PREVIEW GAMBAR BARU ---
        document.getElementById('new_images').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('new-image-preview');
            previewContainer.innerHTML = '';
            Array.from(this.files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgWrapper = document.createElement('div');
                        imgWrapper.classList.add('image-wrapper');
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('preview-thumbnail');
                        imgWrapper.appendChild(img);
                        previewContainer.appendChild(imgWrapper);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // --- SCRIPT UNTUK FUNGSI HAPUS GAMBAR LAMA ---
        document.querySelectorAll('.delete-image-btn').forEach(button => {
            button.addEventListener('click', function() {
                const imageId = this.dataset.imageId;
                const checkbox = document.getElementById('delete_' + imageId);
                const imageThumbnail = this.previousElementSibling;

                // Toggle status checked pada checkbox
                checkbox.checked = !checkbox.checked;

                // Toggle style visual untuk menandakan gambar akan dihapus
                imageThumbnail.classList.toggle('image-marked-for-deletion');
            });
        });
    </script>
</body>

</html>