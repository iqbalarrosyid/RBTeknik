<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="hero-section text-center text-white d-flex align-items-center">
    <div class="container" data-aos="fade-up">
        <h1 class="display-3 fw-bold">Furniture Industrial untuk Ruang Modern Anda</h1>
        <p class="lead col-lg-8 mx-auto">
            Furniture Industrial untuk Ruang Modern Anda
            Hadir dengan sentuhan besi kokoh dan aluminium elegan, produk kami menghadirkan nuansa industrial yang modern dan tahan lama.
            Dari stool, kursi, hingga meja, setiap detail dirancang dengan presisi untuk memberi kenyamanan, keindahan, sekaligus kekuatan.
            Cocok untuk rumah, kafe, kantor, maupun ruang usaha Anda.
        </p>
        <div class="mt-4">
            <a href="<?= base_url('/products'); ?>" class="btn btn-dark btn-lg fw-bold px-5 py-3 me-2 mb-2">Lihat Produk</a>
            <a href="#about" class="btn btn-outline-light btn-lg fw-bold px-5 py-3 mb-2">Tentang Kami</a>
        </div>
    </div>
</section>


<section class="container py-5">
    <div class="row text-center g-4">
        <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="p-4">
                <i class="bi bi-gem fs-2 text-dark"></i>
                <h4 class="fw-bold my-3">Kualitas Premium</h4>
                <p class="text-muted">Dibuat dari material solid pilihan yang menjamin kekuatan dan keindahan alami.</p>
            </div>
        </div>
        <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="p-4">
                <i class="bi bi-rulers fs-2 text-dark"></i>
                <h4 class="fw-bold my-3">Desain Kustom</h4>
                <p class="text-muted">Wujudkan furnitur impian Anda dengan layanan desain yang bisa disesuaikan sepenuhnya.</p>
            </div>
        </div>
        <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="p-4">
                <i class="bi bi-hand-thumbs-up fs-2 text-dark"></i>
                <h4 class="fw-bold my-3">Tangan Terampil</h4>
                <p class="text-muted">Setiap produk adalah hasil karya tangan para pengrajin berpengalaman kami.</p>
            </div>
        </div>
    </div>
</section>


<section id="about" class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="img-container-fixed rounded shadow">
                    <img src="https://images.pexels.com/photos/3757055/pexels-photo-3757055.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Proses Pembuatan Furnitur">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="section-title">Welcome to RB Teknik 37</h2>
                <p class="lead">Where Artistry Meets Craftsmanship.</p>
                <p>Kami adalah pengrajin furnitur dengan pengalaman bertahun-tahun dalam menciptakan karya yang memadukan seni dan fungsi. Setiap produk kami dibuat dari material pilihan dengan detail pengerjaan yang rapi.</p>
                <a href="<?= base_url('/about'); ?>" class="btn btn-outline-dark mt-3">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </div>
</section>


<section class="container py-5">
    <h2 class="text-center section-title" data-aos="fade-up">Produk Terbaru</h2>
    <div class="row g-4">
        <?php if (!empty($latestProducts)): ?>
            <?php foreach ($latestProducts as $i => $product): ?>
                <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="<?= $i * 100 ?>">
                    <div class="card product-card h-100 border-0 overflow-hidden">
                        <div class="product-card-img-container">
                            <a href="<?= base_url('product/' . $product['id']) ?>">
                                <img src="<?= base_url('uploads/products/' . ($product['image_url'] ?? 'default.jpg')) ?>"
                                    class="card-img-top"
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
                            <?php if (!empty($product['price'])): ?>
                                <p class="card-text fw-bold fs-6 text-dark mb-0">
                                    Rp <?= number_format($product['price'], 0, ',', '.') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Belum ada produk.</p>
        <?php endif; ?>
    </div>
</section>


<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center section-title" data-aos="fade-up">Apa Kata Mereka</h2>
        <div class="splide testimonial-slider" data-aos="fade-up" data-aos-delay="200">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <div class="testimonial-card">
                            <div class="stars">★★★★★</div>
                            <p class="quote">"Kualitasnya luar biasa, detailnya rapi banget. Meja makannya jadi pusat perhatian di rumah. Sangat direkomendasikan!"</p>
                            <p class="author">- Budi Santoso, Jakarta</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="testimonial-card">
                            <div class="stars">★★★★★</div>
                            <p class="quote">"Proses pesanan kustomnya mudah dan hasilnya persis seperti yang saya bayangkan. Timnya sangat membantu. Terima kasih RB Teknik 37!"</p>
                            <p class="author">- Citra Lestari, Surabaya</p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="testimonial-card">
                            <div class="stars">★★★★★</div>
                            <p class="quote">"Pengirimannya aman dan tepat waktu. Barangnya sampai tanpa lecet sedikitpun. Kualitasnya top, kayunya solid banget."</p>
                            <p class="author">- Ahmad Ridwan, Bandung</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="container py-5" data-aos="fade-up">
    <h2 class="text-center section-title">Artikel Terbaru</h2>
    <div class="row g-4">
        <?php if (!empty($latestBlogs)): ?>
            <?php foreach ($latestBlogs as $i => $blog): ?>
                <div class="col-12 col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="<?= $i * 100 ?>">

                    <div class="card product-card h-100 border-0 overflow-hidden">
                        <div class="product-card-img-container">
                            <a href="<?= base_url('blog/' . $blog['id']) ?>">
                                <?php
                                $thumbnail = $blog['thumbnail'] ?? 'default.jpg';
                                ?>
                                <img src="<?= base_url('uploads/blog/' . esc($thumbnail)) ?>"
                                    class="card-img-top"
                                    alt="<?= esc($blog['title']) ?>"
                                    style="aspect-ratio: 16/9; object-fit: cover;">
                            </a>
                            <div class="product-card-overlay">
                                <a href="<?= base_url('blog/' . $blog['id']) ?>" class="btn btn-light fw-bold">Baca Selengkapnya</a>
                            </div>
                        </div>
                        <div class="card-body text-start d-flex flex-column">
                            <p class="card-text text-muted mb-2"><small><?= date('d M Y', strtotime($blog['created_at'])) ?></small></p>
                            <h5 class="card-title mt-0 flex-grow-1">
                                <a href="<?= base_url('blog/' . $blog['id']) ?>" class="text-decoration-none text-dark">
                                    <?= esc($blog['title']) ?>
                                </a>
                            </h5>
                            <p class="card-text text-secondary mb-0 mt-auto truncate-text">
                                <?= word_limiter(strip_tags($blog['content']), 15) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Belum ada artikel.</p>
        <?php endif; ?>
    </div>
</section>



<section class="py-5 text-center cta-section my-4" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center section-title">Punya Ide Desain Sendiri?</h2>
        <p class="lead mb-4">Wujudkan furnitur impian Anda bersama kami. Hubungi untuk konsultasi desain kustom.</p>
        <a href="<?= base_url('/contact'); ?>" class="btn btn-dark btn-lg fw-bold">Hubungi Kami</a>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('page_scripts') ?>
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?= base_url('hero.jpg') ?>') center center/cover no-repeat;
        height: 90vh;
        min-height: 600px;
    }

    .testimonial-card {
        background-color: #f8f9fa;
        padding: 2rem;
        border-radius: 0.5rem;
        text-align: center;
        border-left: 5px solid #E0C9A6;
        height: 100%;
    }

    .testimonial-card .stars {
        color: #ffc107;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .testimonial-card .quote {
        font-style: italic;
        color: #495057;
    }

    .testimonial-card .author {
        font-weight: bold;
        margin-top: 1.5rem;
        color: #212529;
    }

    .splide__pagination__page.is-active {
        background: #212529 !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi untuk Testimonial Slider
        if (document.querySelector('.testimonial-slider')) {
            new Splide('.testimonial-slider', {
                type: 'loop',
                perPage: 2,
                perMove: 1,
                gap: '1.5rem',
                pagination: true,
                arrows: false,
                breakpoints: {
                    768: {
                        perPage: 1,
                    },
                }
            }).mount();
        }
    });
</script>
<?= $this->endSection() ?>