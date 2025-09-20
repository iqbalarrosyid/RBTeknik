<?= $this->extend('layout/admintemplate') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <h2 class="fw-bold text-dark mb-0"><i class="bi bi-box-seam me-2"></i> Daftar Produk</h2>
        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/product/create'); ?>" class="btn btn-dark fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Tambah Produk
            </a>
        </div>
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
                                        <span class="badge rounded-pill badge-custom fw-normal text-black"><?= esc($product['category']) ?></span>

                                        <!-- Tampilkan varian jika ada -->
                                        <?php if (!empty($product['variants'])): ?>
                                            <ul class="list-unstyled mt-1 mb-0 small">
                                                <?php foreach ($product['variants'] as $variant): ?>
                                                    <li>
                                                        <span class="fw-bold"><?= esc($variant['variant_name']) ?></span> -
                                                        Rp <?= number_format($variant['price'], 0, ',', '.') ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
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
                                            <img src="<?= base_url('uploads/products/' . $firstImage) ?>" class="blog-thumb">
                                            <?php if ($extraImagesCount > 0): ?>
                                                <span class="badge rounded-pill bg-dark image-count-badge">+<?= $extraImagesCount ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?= base_url('admin/product/edit/' . $product['id']); ?>"
                                                class="btn-action text-warning"
                                                data-bs-toggle="tooltip"
                                                title="Edit Produk">
                                                <i class="bi bi-pencil-square fs-5"></i>
                                            </a>
                                            <form action="<?= base_url('admin/product/delete/' . $product['id']); ?>"
                                                method="post"
                                                onsubmit="return confirm('Yakin hapus produk ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit"
                                                    class="btn-action text-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="Hapus Produk">
                                                    <i class="bi bi-trash3-fill fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
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
    </div>
    <br>
    <div class="d-flex justify-content-center">
        <?= $pager->links('products', 'bootstrap_5_pagination') ?>
    </div>
</div>

<script>
    // Inisialisasi Tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function(el) {
        return new bootstrap.Tooltip(el)
    })
</script>
<?= $this->endSection() ?>