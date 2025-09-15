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
        .fw-semibold,
        .btn {
            font-family: 'Montserrat', sans-serif;
        }

        .table thead {
            background-color: #343a40;
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
            transition: color 0.2s ease;
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
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h2 class="fw-bold text-dark mb-0"><i class="bi bi-box-seam me-2"></i> Daftar Produk</h2>
            <a href="<?= base_url('admin/product/create'); ?>" class="btn btn-dark fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk
            </a>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="get" action="<?= base_url('admin/'); ?>" class="d-md-flex justify-content-between align-items-center">
                    <div class="input-group flex-grow-1 me-md-3 mb-3 mb-md-0">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau kategori produk..." value="<?= esc($search ?? '') ?>">
                        <button class="btn btn-dark" type="submit" aria-label="Cari">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <div class="d-flex align-items-center flex-shrink-0">
                        <label for="sort" class="form-label me-2 mb-0 d-none d-md-inline">Urutkan:</label>
                        <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                            <option value="" <?= empty($sort) ? 'selected' : '' ?>>Paling Sesuai</option>
                            <option value="az" <?= ($sort ?? '') == 'az' ? 'selected' : '' ?>>Nama A-Z</option>
                            <option value="za" <?= ($sort ?? '') == 'za' ? 'selected' : '' ?>>Nama Z-A</option>
                            <option value="low_high" <?= ($sort ?? '') == 'low_high' ? 'selected' : '' ?>>Harga Termurah</option>
                            <option value="high_low" <?= ($sort ?? '') == 'high_low' ? 'selected' : '' ?>>Harga Termahal</option>
                        </select>
                    </div>
                </form>
            </div>
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
                            <?php if (!empty($products)): ?>
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
                                            $images = $product['images'] ?? [];
                                            $firstImage = !empty($images) ? $images[0]['image_url'] : 'default.jpg';
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
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Produk tidak ditemukan. Coba ubah kata kunci pencarian Anda.</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
                <div class="card-footer bg-white">
                    <?= $pager->links('default', 'bootstrap_5_pagination') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Inisialisasi Tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function(el) {
            return new bootstrap.Tooltip(el)
        })
    </script>
</body>

</html>