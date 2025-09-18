<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="main-content-wrapper">
    <!-- Hero Section -->
    <section class="container py-5 my-4 order-lg-2" data-aos="fade-up">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center" data-aos="fade-right">
                <h2 class="section-title text-center">Welcome To RB Teknik</h2>
                <p class="lead text-center">
                    Where Artistry Meets Craftsmanship. Discover the timeless beauty and quality of our handcrafted wood creations, meticulously designed to adorn your life with elegance and durability.
                </p>
                <a href="<?= base_url('/products'); ?>" class="btn btn-custom btn-lg">Selengkapnya</a>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="https://images.pexels.com/photos/3757055/pexels-photo-3757055.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    class="img-fluid rounded shadow" alt="Proses Pembuatan Furnitur">
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section class="container py-5 my-4 order-lg-1" data-aos="zoom-in">
        <div class="row g-5">
            <div class="col-12">
                <h2 class="section-title text-center">Tentang Kami</h2>
                <p class="lead text-center">
                    Kami adalah pengrajin furnitur dengan pengalaman bertahun-tahun dalam menciptakan karya yang memadukan seni dan fungsi.
                    Setiap produk kami dibuat dari material pilihan dengan detail pengerjaan yang rapi, menjamin kenyamanan, keindahan, dan daya tahan.
                </p>
            </div>
        </div>
    </section>
</div>

<!-- Filosofi -->
<section class="py-5 bg-white" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center section-title">Filosofi Kami</h2>
        <div class="row text-center g-4">
            <div class="col-md-4" data-aos="flip-left">
                <div class="p-4">
                    <i class="bi bi-gem fs-1 text-dark"></i>
                    <h4 class="fw-bold my-3">Kualitas Terbaik</h4>
                    <p class="text-muted">
                        Kami hanya menggunakan material kayu pilihan yang telah melewati proses seleksi ketat untuk menjamin kekuatan dan daya tahan produk.
                    </p>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-up">
                <div class="p-4">
                    <i class="bi bi-rulers fs-1 text-dark"></i>
                    <h4 class="fw-bold my-3">Desain Kustom</h4>
                    <p class="text-muted">
                        Setiap klien adalah unik. Kami bekerja sama dengan Anda untuk mewujudkan furnitur impian yang sesuai dengan gaya dan kebutuhan Anda.
                    </p>
                </div>
            </div>
            <div class="col-md-4" data-aos="flip-right">
                <div class="p-4">
                    <i class="bi bi-hand-thumbs-up fs-1 text-dark"></i>
                    <h4 class="fw-bold my-3">Sentuhan Tangan Ahli</h4>
                    <p class="text-muted">
                        Dikerjakan oleh para pengrajin berpengalaman, setiap detail furnitur kami mendapatkan perhatian penuh untuk hasil akhir yang sempurna.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Produk Terbaru -->
<section class="container py-5" data-aos="fade-up">
    <h2 class="text-center section-title">Produk Terbaru</h2>
    <div class="row g-4">
        <?php if (!empty($latestProducts)): ?>
            <?php foreach ($latestProducts as $i => $product): ?>
                <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="<?= $i * 100 ?>">
                    <div class="card product-card h-100">
                        <img src="<?= base_url('uploads/products/' . ($product['image_url'] ?? 'default.jpg')) ?>"
                            class="card-img-top"
                            alt="<?= esc($product['product_name']) ?>">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title mt-2"><?= esc($product['product_name']) ?></h5>
                            <p class="card-text truncate-text"><?= esc($product['description']) ?></p>
                            <p class="card-text text-muted mb-1"><?= esc($product['category']) ?></p>
                            <p class="fw-bold text-dark mt-auto">
                                Rp <?= number_format($product['price'], 0, ',', '.') ?>
                            </p>
                            <a href="<?= base_url('product/' . $product['id']) ?>" class="btn btn-sm btn-dark mt-2">Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Belum ada produk.</p>
        <?php endif; ?>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center cta-section my-4" data-aos="fade-up">
    <div class="container">
        <h2 class="text-center section-title">Punya Ide Desain Sendiri?</h2>
        <p class="lead mb-4">Wujudkan furnitur impian Anda bersama kami. Hubungi untuk konsultasi desain kustom.</p>
        <a href="<?= base_url('/contact'); ?>" class="btn btn-custom btn-lg">Hubungi Kami</a>
    </div>
</section>

<?= $this->endSection() ?>