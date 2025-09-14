<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="main-content-wrapper">
    <section class="container py-5 my-4 order-lg-2">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center">
                <h2 class="section-title text-center">Welcome To RB Teknik</h2>
                <p class="lead text-center">Where Artistry Meets Craftsmanship. Discover the timeless beauty and quality of our handcrafted wood creations, meticulously designed to adorn your life with elegance and durability.</p>
                <a href="<?= base_url('/products'); ?>" class="btn btn-custom btn-lg">Selengkapnya</a>
            </div>
            <div class="col-lg-6">
                <img src="https://images.pexels.com/photos/3757055/pexels-photo-3757055.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid rounded shadow" alt="Proses Pembuatan Furnitur">
            </div>
        </div>
    </section>

    <section class="container py-5 my-4 order-lg-1">
        <div class="row g-5">
            <div class="col-12">
                <h2 class="section-title text-center">Tentang Kami</h2>
                <p class="lead text-center">Kami adalah pengrajin furnitur dengan pengalaman bertahun-tahun dalam menciptakan karya yang memadukan seni dan fungsi. Setiap produk kami dibuat dari material pilihan dengan detail pengerjaan yang rapi, menjamin kenyamanan, keindahan, dan daya tahan.</p>
            </div>
        </div>
    </section>
</div>

<section class="container py-5">
    <h2 class="text-center section-title">Produk Unggulan</h2>
    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card product-card h-100">
                <img src="https://images.pexels.com/photos/2082087/pexels-photo-2082087.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Kursi Kayu Elegan">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title mt-2">Kursi Kayu Jati</h5>
                    <p class="card-text">Nyaman, kokoh, dengan desain minimalis modern.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card product-card h-100">
                <img src="https://images.pexels.com/photos/6489083/pexels-photo-6489083.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Meja Tamu Minimalis">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title mt-2">Meja Tamu Minimalis</h5>
                    <p class="card-text">Titik fokus elegan untuk ruang tamu maupun kantor.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card product-card h-100">
                <img src="https://images.pexels.com/photos/279648/pexels-photo-279648.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Set Meja Makan">
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title mt-2">Set Meja Makan</h5>
                    <p class="card-text">Pilihan terbaik untuk kehangatan ruang makan & café.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 text-center cta-section my-4">
    <div class="container">
        <h2 class="text-center section-title">Punya Ide Desain Sendiri?</h2>
        <p class="lead mb-4">Wujudkan furnitur impian Anda bersama kami. Hubungi untuk konsultasi desain kustom.</p>
        <a href="<?= base_url('/contact'); ?>" class="btn btn-custom btn-lg">Hubungi Kami</a>
    </div>
</section>

<?= $this->endSection() ?>