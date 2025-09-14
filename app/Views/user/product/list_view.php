<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="container py-5">
    <h1 class="text-center section-title">Produk Kami</h1>
    <p class="lead text-center mb-5">
        Jelajahi koleksi furnitur berkualitas tinggi yang kami tawarkan, dibuat dengan presisi dan sentuhan seni.
    </p>

    <?php if (!empty($products)): ?>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card product-card h-100 shadow-sm border-0">
                        <img src="<?= base_url('uploads/products/' . esc($product['image_url'] ?? 'default.jpg')) ?>"
                            class="card-img-top"
                            alt="<?= esc($product['product_name']) ?>"
                            style="aspect-ratio: 1/1; object-fit: cover;">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title mt-2"><?= esc($product['product_name']) ?></h5>
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
        <div class="col-12">
            <p class="text-center text-muted">Saat ini belum ada produk yang tersedia.</p>
        </div>
    <?php endif; ?>
</section>

<?= $this->endSection() ?>