<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Produk - Admin Panel</title>

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

        .table thead {
            background-color: #495057;
            /* Warna abu-abu gelap yang lebih lembut */
            color: #fff;
        }

        .table th,
        .table td {
            vertical-align: middle;
            padding: 1rem;
        }

        .product-thumb-wrapper {
            position: relative;
            display: inline-block;
        }

        .product-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .image-count-badge {
            position: absolute;
            top: -5px;
            right: -10px;
            font-size: 0.75rem;
            padding: 0.2em 0.5em;
        }

        .truncate-text {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .badge-custom {
            font-size: 0.8rem;
            padding: 0.4em 0.8em;
            background-color: #e9ecef !important;
            color: #495057 !important;
        }

        .btn-action {
            background: none;
            border: none;
            color: #6c757d;
            padding: 0.375rem 0.75rem;
        }

        .btn-action:hover {
            color: #212529;
        }

        .btn-action.text-warning:hover {
            color: #ffc107 !important;
        }

        .btn-action.text-danger:hover {
            color: #dc3545 !important;
        }
    </style>
</head>

<body class="py-5">

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark"><i class="bi bi-box-seam me-2"></i> Daftar Produk</h2>
            <a href="<?= base_url('admin/product/create'); ?>" class="btn btn-dark fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Produk</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th class="text-center">Foto</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= esc($product['product_name']) ?></div>
                                        <span class="badge rounded-pill badge-custom fw-normal"><?= esc($product['category']) ?></span>
                                    </td>
                                    <td>
                                        <div class="truncate-text" title="<?= esc($product['description']) ?>"><?= esc($product['description']) ?></div>
                                    </td>
                                    <td class="fw-bold">
                                        Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        // Asumsi $product['images'] adalah array gambar dari relasi
                                        $images = $product['images'] ?? [];
                                        $firstImage = !empty($images) ? $images[0]['image_url'] : 'default.jpg'; // Ganti 'default.jpg' jika perlu
                                        $extraImagesCount = count($images) - 1;
                                        ?>
                                        <div class="product-thumb-wrapper">
                                            <img src="<?= base_url('uploads/products/' . $firstImage) ?>" class="product-thumb">
                                            <?php if ($extraImagesCount > 0): ?>
                                                <span class="badge rounded-pill bg-dark image-count-badge">+<?= $extraImagesCount ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/product/edit/' . $product['id']); ?>" class="btn-action text-warning" data-bs-toggle="tooltip" title="Edit Produk">
                                            <i class="bi bi-pencil-square fs-5"></i>
                                        </a>
                                        <form action="<?= base_url('admin/product/delete/' . $product['id']); ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus produk ini?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn-action text-danger" data-bs-toggle="tooltip" title="Hapus Produk">
                                                <i class="bi bi-trash3-fill fs-5"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inisialisasi semua tooltip di halaman
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>