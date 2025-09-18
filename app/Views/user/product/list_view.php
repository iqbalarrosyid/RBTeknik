<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="container py-5">
    <div data-aos="fade-up">
        <h1 class="text-center section-title">Produk Kami</h1>
    </div>

    <div class="alert shopee-alert d-flex flex-column flex-md-row align-items-center justify-content-between p-4 mb-4 shadow-sm rounded-3" role="alert" data-aos="fade-up" data-aos-delay="100">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <i class="bi bi-shop-window fs-2 me-3"></i>
            <div>
                <h5 class="fw-bold mb-0">Kini Hadir di Shopee!</h5>
                <span>Belanja produk kami lebih mudah dan dapatkan promo menarik.</span>
            </div>
        </div>
        <a href="https://shopee.co.id/rbteknik37" target="_blank" class="btn btn-shopee px-4 py-2 flex-shrink-0">
            Kunjungi Toko Kami <i class="bi bi-arrow-right-short"></i>
        </a>
    </div>

    <div class="p-4 mb-5 bg-white rounded-3 shadow-sm" data-aos="fade-up" data-aos-delay="200">
        <form method="get" action="<?= base_url('products') ?>">
            <div class="row g-3 align-items-center">
                <div class="col-lg-5 col-md-12">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                        <input type="search" name="search" class="form-control border-0 bg-light" placeholder="Cari kursi, meja, dll..." value="<?= esc($search ?? '') ?>">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= esc($cat['category']) ?>" <?= ($category ?? '') == $cat['category'] ? 'selected' : '' ?>>
                                <?= esc($cat['category']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-3 col-md-6">
                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="" <?= empty($sort) ? 'selected' : '' ?>>Urutkan</option>
                        <option value="az" <?= ($sort ?? '') == 'az' ? 'selected' : '' ?>>Nama A-Z</option>
                        <option value="za" <?= ($sort ?? '') == 'za' ? 'selected' : '' ?>>Nama Z-A</option>
                        <option value="low_high" <?= ($sort ?? '') == 'low_high' ? 'selected' : '' ?>>Harga Termurah</option>
                        <option value="high_low" <?= ($sort ?? '') == 'high_low' ? 'selected' : '' ?>>Harga Termahal</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <?php if (!empty($products)): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col" data-aos="fade-up">
                    <div class="card product-card h-100 border-0 overflow-hidden">
                        <div class="product-card-img-container">
                            <a href="<?= base_url('product/' . $product['id']) ?>">
                                <img src="<?= base_url('uploads/products/' . esc($product['product_image'] ?? 'default.jpg')) ?>"
                                    class="card-img-top"
                                    style="aspect-ratio: 16/9;"
                                    alt="<?= esc($product['product_name']) ?>">
                            </a>
                            <div class="product-card-overlay">
                                <a href="<?= base_url('product/' . $product['id']) ?>" class="btn btn-light fw-bold">Lihat Detail</a>
                            </div>
                        </div>
                        <div class="card-body text-start">
                            <p class="card-text text-muted mb-1 small"><?= esc($product['category']) ?></p>
                            <h5 class="card-title mt-0">
                                <a href="<?= base_url('product/' . $product['id']) ?>" class="text-decoration-none text-dark"><?= esc($product['product_name']) ?></a>
                            </h5>
                            <p class="card-text fw-bold fs-6 text-dark mb-0">
                                Rp <?= number_format($product['price'], 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-5 d-flex justify-content-center">
            <?= $pager->links('products', 'bootstrap_5_pagination') ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <h4 class="text-muted">Produk tidak ditemukan</h4>
            <p>Coba gunakan kata kunci pencarian atau filter yang lain.</p>
            <a href="<?= base_url('products') ?>" class="btn btn-dark mt-3">Tampilkan Semua Produk</a>
        </div>
    <?php endif; ?>
</section>

<?= $this->endSection() ?>


<?= $this->section('page_scripts') ?>
<style>
    /* Style baru untuk kartu produk yang lebih interaktif */
    .product-card {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.3s ease;
    }

    .product-card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .product-card-img-container {
        position: relative;
        overflow: hidden;
    }

    .product-card .card-img-top {
        aspect-ratio: 1/1;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .product-card:hover .card-img-top {
        transform: scale(1.05);
    }

    .product-card-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 1rem;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }

    .product-card:hover .product-card-overlay {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<?= $this->endSection() ?>