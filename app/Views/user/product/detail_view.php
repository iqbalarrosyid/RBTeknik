<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-6">
            <div class="mb-3">
                <img src="<?= base_url('uploads/products/' . esc($images[0]['image_url'] ?? 'default.jpg')) ?>" class="img-fluid rounded shadow-sm w-100"
                    id="main-product-image"
                    alt="<?= esc($product['product_name']) ?>"
                    style="cursor: zoom-in; aspect-ratio: 1/1; object-fit: cover;"
                    onclick="openImageModal(this.src)">
            </div>

            <?php if (!empty($images) && count($images) > 1): ?>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($images as $index => $image): ?>
                        <div class="thumbnail-wrapper">
                            <img src="<?= base_url('uploads/products/' . esc($image['image_url'])) ?>"
                                class="rounded product-thumbnail <?= $index === 0 ? 'active' : '' ?>"
                                onclick="changeImage(this)"
                                alt="Thumbnail <?= $index + 1 ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>

        <div class="col-lg-6">
            <h1 class="display-5 fw-bold"><?= esc($product['product_name']) ?></h1>
            <p class="text-muted fs-5 mb-3">Kategori: <span class="fw-semibold text-dark"><?= esc($product['category']) ?></span></p>
            <p class="display-4 fw-bold text-dark mb-4">
                Rp <?= number_format($product['price'], 0, ',', '.') ?>
            </p>

            <hr class="my-4">

            <h5 class="fw-bold">Spesifikasi Utama</h5>
            <ul class="list-unstyled lead fs-6">
                <li class="mb-2">
                    <i class="bi bi-box-seam me-2 text-muted"></i>
                    Bahan: <?= !empty($product['bahan']) ? esc($product['bahan']) : '-' ?>
                </li>
                <li class="mb-2">
                    <i class="bi bi-palette me-2 text-muted"></i>
                    Warna: <?= !empty($product['warna']) ? esc($product['warna']) : '-' ?>
                </li>
                <li class="mb-2">
                    <i class="bi bi-rulers me-2 text-muted"></i>
                    Dimensi:
                    <?php if (!empty($product['panjang']) && !empty($product['lebar']) && !empty($product['tinggi'])): ?>
                        <?= esc($product['panjang']) ?> x <?= esc($product['lebar']) ?> x <?= esc($product['tinggi']) ?> cm
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </li>
            </ul>


            <hr class="my-4">

            <h5 class="fw-bold">Deskripsi Produk</h5>
            <p class="text-secondary"><?= nl2br(esc($product['description'])) ?></p>

            <div class="mt-5">
                <?php
                $pesan_wa = "Halo, saya tertarik dengan produk '" . $product['product_name'] . "'. Bisa minta info lebih lanjut?";
                ?>
                <a href="https://wa.me/6283894056521?text=<?= urlencode($pesan_wa) ?>"
                    target="_blank"
                    class="btn btn-dark btn-lg px-5 py-3 fw-bold">
                    <i class="bi bi-whatsapp me-2"></i>Pesan via WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($related_products)): ?>
    <section class="container py-5 mt-5">
        <h2 class="text-center section-title">Anda Mungkin Juga Suka</h2>
        <div class="row g-4">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-4">
                <?php foreach ($related_products as $related): ?>
                    <div class="col">
                        <div class="card product-card h-100 shadow-sm border-0">
                            <img src="<?= base_url('uploads/products/' . esc($related['image_url'] ?? 'default.jpg')) ?>"
                                class="card-img-top"
                                alt="<?= esc($related['product_name']) ?>"
                                style="aspect-ratio: 1/1; object-fit: cover;">
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title mt-2"><?= esc($related['product_name']) ?></h5>
                                <p class="card-text text-muted mb-1"><?= esc($related['category']) ?></p>
                                <p class="card-text fw-bold fs-6 text-dark mb-3">
                                    Rp <?= number_format($related['price'], 0, ',', '.') ?>
                                </p>
                                <div class="mt-auto">
                                    <a href="<?= base_url('product/' . $related['id']) ?>" class="btn btn-dark btn-sm px-3">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


        </div>
    </section>
<?php endif; ?>

<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body d-flex justify-content-center align-items-center p-0">
                <img id="zoomedImage" src="" class="w-100 h-100" style="object-fit: contain;">
            </div>
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 fs-4" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('page_scripts') ?>
<style>
    .thumbnail-wrapper {
        width: 90px;
        height: 90px;
    }

    .product-thumbnail {
        cursor: pointer;
        border: 2px solid transparent;
        transition: border-color 0.2s ease, transform 0.2s ease;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-thumbnail:hover,
    .product-thumbnail.active {
        border-color: #E0C9A6;
        /* Warna aksen emas */
        transform: scale(1.05);
    }

    .modal-content {
        backdrop-filter: blur(5px);
    }
</style>

<script>
    function changeImage(thumbElement) {
        const newImageUrl = thumbElement.src;
        document.getElementById('main-product-image').src = newImageUrl;

        document.querySelectorAll('.product-thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        thumbElement.classList.add('active');
    }

    function openImageModal(src) {
        document.getElementById('zoomedImage').src = src;
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }
</script>
<?= $this->endSection() ?>