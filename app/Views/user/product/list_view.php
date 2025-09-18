<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="container py-5">
    <h1 class="text-center section-title">Produk Kami</h1>
    <p class="lead text-center mb-5">
        Jelajahi koleksi furnitur berkualitas tinggi yang kami tawarkan, dibuat dengan presisi dan sentuhan seni.
    </p>

    <div class="p-4 mb-5 bg-white rounded-3 shadow-sm">
        <form method="get" action="<?= base_url('products') ?>" class="d-md-flex justify-content-between align-items-center">

            <div class="input-group flex-grow-1 me-md-3 mb-3 mb-md-0">
                <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                <input type="search" name="search" class="form-control form-control-lg border-0 bg-light"
                    placeholder="Cari produk..." value="<?= esc($search ?? '') ?>">

            </div>

            <div class="d-flex align-items-center flex-shrink-0">
                <label class="form-label me-2 mb-0 d-none d-md-inline">Urutkan:</label>
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="" <?= empty($sort) ? 'selected' : '' ?>>Paling Sesuai</option>
                    <option value="az" <?= ($sort ?? '') == 'az' ? 'selected' : '' ?>>Nama A-Z</option>
                    <option value="za" <?= ($sort ?? '') == 'za' ? 'selected' : '' ?>>Nama Z-A</option>
                    <option value="low_high" <?= ($sort ?? '') == 'low_high' ? 'selected' : '' ?>>Harga Termurah</option>
                    <option value="high_low" <?= ($sort ?? '') == 'high_low' ? 'selected' : '' ?>>Harga Termahal</option>
                </select>
            </div>
        </form>
    </div>



    <?php if (!empty($products)): ?>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card product-card h-100 border-0">
                        <a href="<?= base_url('product/' . $product['id']) ?>">
                            <img src="<?= base_url('uploads/products/' . esc($product['product_image'] ?? 'default.jpg')) ?>"
                                class="card-img-top"
                                alt="<?= esc($product['product_name']) ?>"
                                style="aspect-ratio: 1/1; object-fit: cover;">

                        </a>
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title mt-2 truncate-text">
                                <a href="<?= base_url('product/' . $product['id']) ?>" class="text-decoration-none text-dark"><?= esc($product['product_name']) ?></a>
                            </h5>
                            <p class="card-text text-muted mb-1"><?= esc($product['category']) ?></p>
                            <p class="card-text fw-bold fs-6 text-dark mb-3">
                                Rp <?= number_format($product['price'], 0, ',', '.') ?>
                            </p>
                            <div class="mt-auto">
                                <a href="<?= base_url('product/' . $product['id']) ?>" class="btn btn-dark btn-sm px-3">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


    <?php else: ?>
        <div class="text-center py-5">
            <h4 class="text-muted">Produk tidak ditemukan</h4>
            <p>Coba gunakan kata kunci pencarian yang lain.</p>
            <a href="<?= base_url('products') ?>" class="btn btn-dark mt-3">Tampilkan Semua Produk</a>
        </div>
    <?php endif; ?>
    <br>

    <?= $pager->links('products', 'bootstrap_5_pagination') ?>

</section>


<?= $this->endSection() ?>