<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-down">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/products') ?>">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= esc($product['product_name']) ?></li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- Gambar Produk & Varian -->
        <div class="col-lg-7" data-aos="fade-right">
            <div class="mb-3 position-relative">
                <img src="<?= base_url('uploads/products/' . esc($images[0]['image_url'] ?? 'default.jpg')) ?>"
                    class="img-fluid rounded shadow-sm w-100"
                    id="main-product-image"
                    alt="<?= esc($product['product_name']) ?>"
                    style="aspect-ratio: 4/3; object-fit: cover;">
                <div class="zoom-overlay">
                    <i class="bi bi-zoom-in"></i>
                </div>
            </div>

            <!-- Slider Gambar Utama -->
            <?php if (!empty($images) && count($images) > 1): ?>
                <div class="splide thumbnail-slider" id="product-thumbnails">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php foreach ($images as $image): ?>
                                <li class="splide__slide">
                                    <img src="<?= base_url('uploads/products/' . esc($image['image_url'])) ?>"
                                        class="rounded product-thumbnail"
                                        alt="Thumbnail"
                                        data-image="<?= base_url('uploads/products/' . esc($image['image_url'])) ?>">
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Varian Produk -->
            <?php if (!empty($variants)): ?>
                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Varian Produk</h5>
                    <div class="d-flex flex-wrap gap-2" id="variant-buttons">
                        <?php foreach ($variants as $variant): ?>
                            <button type="button" class="btn btn-outline-dark btn-sm variant-btn"
                                data-images='<?= json_encode(array_column($variant['images'] ?? [], 'image_url')) ?>'
                                data-price="<?= esc($variant['price']) ?>"
                                data-stock="<?= esc($variant['stock']) ?>">
                                <?= esc($variant['variant_name']) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Detail Produk -->
        <div class="col-lg-5" data-aos="fade-left" data-aos-delay="200">
            <h1 class="display-5 fw-bold" id="product-name"><?= esc($product['product_name']) ?></h1>
            <p class="text-muted fs-5 mb-3">
                Kategori: <a href="<?= base_url('products?category=' . urlencode($product['category'])) ?>" class="text-decoration-none text-dark fw-semibold"><?= esc($product['category']) ?></a>
            </p>
            <p class="display-4 fw-bold text-dark mb-4" id="product-price">
                <?php if (!empty($variants)): ?>
                    Rp <?= number_format($min_price, 0, ',', '.') ?>
                    <?php if ($min_price != $max_price): ?>
                        - Rp <?= number_format($max_price, 0, ',', '.') ?>
                    <?php endif; ?>
                <?php else: ?>
                    Rp <?= number_format($product['price'], 0, ',', '.') ?>
                <?php endif; ?>
            </p>


            <div class="d-flex align-items-center mb-4">
                <button type="button" id="copyLinkBtn" class="btn btn-outline-dark me-2" data-bs-toggle="tooltip" title="Salin link produk">
                    <i class="bi bi-link-45deg"></i>
                </button>
                <div class="dropdown">
                    <button class="btn btn-outline-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Bagikan">
                        <i class="bi bi-share-fill"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="https://api.whatsapp.com/send?text=<?= urlencode(esc($product['product_name']) . ' ' . current_url()) ?>" target="_blank">WhatsApp</a></li>
                        <li><a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank">Facebook</a></li>
                        <li><a class="dropdown-item" href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode(esc($product['product_name'])) ?>" target="_blank">Twitter</a></li>
                    </ul>
                </div>
            </div>

            <?php
            $pesan_wa = "Halo, saya tertarik dengan produk '" . $product['product_name'] . "'. Bisa minta info lebih lanjut?";
            ?>
            <div class="d-grid mb-4">
                <a href="https://wa.me/6283894056521?text=<?= urlencode($pesan_wa) ?>"
                    target="_blank"
                    class="btn btn-dark btn-lg py-3 fw-bold">
                    <i class="bi bi-whatsapp me-2"></i>Pesan via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Tabs Deskripsi & Spesifikasi -->
    <div class="row mt-5">
        <div class="col-12" data-aos="fade-up">
            <div class="product-tabs">
                <ul class="nav nav-tabs" id="productTab" role="tablist">
                    <li class="nav-item" role="presentation"><button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-pane" type="button">Deskripsi</button></li>
                    <li class="nav-item" role="presentation"><button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs-pane" type="button">Spesifikasi</button></li>
                </ul>
                <div class="tab-content bg-white p-4 p-md-5" id="productTabContent">
                    <div class="tab-pane fade show active" id="description-pane" role="tabpanel"><?= nl2br(esc($product['description'])) ?></div>
                    <div class="tab-pane fade" id="specs-pane" role="tabpanel">
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong>Bahan:</strong> <?= !empty($product['bahan']) ? esc($product['bahan']) : 'Kayu Jati Pilihan' ?></li>
                            <li class="mb-2"><strong>Warna:</strong> <?= !empty($product['warna']) ? esc($product['warna']) : 'Natural Doff' ?></li>
                            <li class="mb-2"><strong>Dimensi:</strong>
                                <?php if (!empty($product['panjang']) && !empty($product['lebar']) && !empty($product['tinggi'])): ?>
                                    <?= esc($product['panjang']) ?> x <?= esc($product['lebar']) ?> x <?= esc($product['tinggi']) ?> cm
                                <?php else: ?>
                                    Tanyakan untuk detail
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Products -->
<?php if (!empty($related_products)): ?>
    <section class="container py-5 mt-4">
        <h2 class="text-center section-title" data-aos="fade-up">Anda Mungkin Juga Suka</h2>
        <div class="row g-4 justify-content-center">
            <?php foreach ($related_products as $related): ?>
                <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in">
                    <div class="card product-card h-100 border-0 overflow-hidden">
                        <div class="product-card-img-container">
                            <a href="<?= base_url('product/' . $related['id']) ?>">
                                <img src="<?= base_url('uploads/products/' . esc($related['image_url'] ?? 'default.jpg')) ?>"
                                    class="card-img-top"
                                    style="aspect-ratio: 16/9;"
                                    alt="<?= esc($related['product_name']) ?>">
                            </a>
                            <div class="product-card-overlay">
                                <a href="<?= base_url('product/' . $related['id']) ?>" class="btn btn-light fw-bold">Lihat Detail</a>
                            </div>
                        </div>
                        <div class="card-body text-start">
                            <p class="card-text text-muted mb-1 small"><?= esc($related['category']) ?></p>
                            <h5 class="card-title mt-0">
                                <a href="<?= base_url('product/' . $related['id']) ?>" class="text-decoration-none text-dark"><?= esc($related['product_name']) ?></a>
                            </h5>
                            <p class="card-text fw-bold fs-6 text-dark mb-0">
                                Rp <?= number_format($related['price'], 0, ',', '.') ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<!-- Modal Zoom -->
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
    .breadcrumb-item a {
        text-decoration: none;
        color: #6c757d;
    }

    .breadcrumb-item a:hover {
        color: #212529;
    }

    .zoom-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0);
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: zoom-in;
        transition: background 0.3s ease;
    }

    .zoom-overlay i {
        font-size: 3rem;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .zoom-overlay:hover {
        background: rgba(0, 0, 0, 0.4);
    }

    .zoom-overlay:hover i {
        opacity: 1;
    }

    .thumbnail-slider .splide__slide {
        padding: 5px;
        cursor: pointer;
    }

    .thumbnail-slider .splide__slide img {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border: 2px solid transparent;
        transition: border-color 0.2s ease;
    }

    .thumbnail-slider .splide__slide.is-active img {
        border-color: #E0C9A6;
    }

    .product-tabs .nav-tabs .nav-link {
        color: #6c757d;
        font-weight: 600;
    }

    .product-tabs .nav-tabs .nav-link.active {
        color: #212529;
        border-color: #dee2e6 #dee2e6 #fff;
    }

    .product-tabs .tab-content {
        border: 1px solid #dee2e6;
        border-top: none;
    }

    .modal-content {
        backdrop-filter: blur(5px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        const mainImage = document.getElementById('main-product-image');
        const zoomTrigger = document.querySelector('.zoom-overlay');
        const imageModalEl = document.getElementById('imageModal');
        if (zoomTrigger && imageModalEl) {
            const imageModal = new bootstrap.Modal(imageModalEl);
            const zoomedImage = document.getElementById('zoomedImage');
            zoomTrigger.addEventListener('click', function() {
                zoomedImage.src = mainImage.src;
                imageModal.show();
            });
        }

        const copyLinkBtn = document.getElementById('copyLinkBtn');
        if (copyLinkBtn) {
            const tooltip = bootstrap.Tooltip.getInstance(copyLinkBtn);
            copyLinkBtn.addEventListener('click', function() {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    const originalTitle = this.getAttribute('data-bs-original-title');
                    this.setAttribute('data-bs-original-title', 'Link disalin!');
                    tooltip.show();
                    setTimeout(() => {
                        tooltip.hide();
                        this.setAttribute('data-bs-original-title', originalTitle);
                    }, 2000);
                });
            });
        }

        // Thumbnail slider
        const thumbnailSlider = document.querySelector('.thumbnail-slider');
        if (thumbnailSlider) {
            const splide = new Splide(thumbnailSlider, {
                perPage: 4,
                gap: '0.5rem',
                rewind: false,
                pagination: false,
                isNavigation: true,
                breakpoints: {
                    768: {
                        perPage: 3
                    }
                }
            }).mount();

            splide.on('click', function(slide) {
                mainImage.src = slide.slide.querySelector('img').dataset.image;
            });
        }

        // Varian produk interaktif
        const variantButtons = document.querySelectorAll('.variant-btn');
        variantButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update harga dan stock
                const price = this.dataset.price;
                document.getElementById('product-price').innerText = "Rp " + Number(price).toLocaleString('id-ID');

                // Update gambar utama
                const images = JSON.parse(this.dataset.images || '[]');
                if (images.length > 0) {
                    mainImage.src = "<?= base_url('uploads/products/') ?>" + images[0];
                }

                // Highlight tombol
                variantButtons.forEach(b => b.classList.remove('btn-dark'));
                this.classList.add('btn-dark');
            });
        });
    });
</script>
<?= $this->endSection() ?>