<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="about-hero text-center text-white d-flex align-items-center">
    <div class="container" data-aos="fade-up">
        <h1 class="display-4 fw-bold">Tentang RB Teknik</h1>
        <p class="lead col-lg-8 mx-auto">
            Lebih dari sekadar furnitur, kami menciptakan warisan. Kenali perjalanan, filosofi, dan orang-orang di balik karya kami.
        </p>
    </div>
</section>


<section class="container py-5">
    <h2 class="text-center section-title" data-aos="fade-up">Perjalanan Kami</h2>
    <div class="timeline">
        <div class="timeline-item" data-aos="fade-right">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <h5 class="fw-bold">2015: Berawal dari Hobi</h5>
                <p class="text-muted">Semuanya dimulai dari sebuah garasi kecil dan kecintaan mendalam terhadap seni pertukangan kayu. Sebuah hobi yang perlahan berubah menjadi passion.</p>
            </div>
        </div>
        <div class="timeline-item" data-aos="fade-left">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <h5 class="fw-bold">2018: Bengkel Pertama Dibuka</h5>
                <p class="text-muted">Dengan semakin banyaknya kepercayaan, kami membuka bengkel kerja pertama kami di Yogyakarta, memberdayakan pengrajin lokal dengan visi yang sama.</p>
            </div>
        </div>
        <div class="timeline-item" data-aos="fade-right">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <h5 class="fw-bold">2022: Inovasi Desain Kustom</h5>
                <p class="text-muted">Kami meluncurkan layanan desain kustom penuh, memungkinkan setiap klien untuk berkolaborasi dan menciptakan furnitur yang benar-benar personal.</p>
            </div>
        </div>
        <div class="timeline-item" data-aos="fade-left">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <h5 class="fw-bold">2025: Melayani Seluruh Indonesia</h5>
                <p class="text-muted">Kini, RB Teknik telah dipercaya untuk mengirimkan karya-karya terbaiknya ke berbagai penjuru nusantara, menghiasi rumah dan bisnis dengan kualitas tanpa kompromi.</p>
            </div>
        </div>
    </div>
</section>


<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center section-title" data-aos="zoom-in">Filosofi Kami</h2>
        <div class="row text-center g-4">
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="p-4">
                    <i class="bi bi-gem fs-1 text-dark"></i>
                    <h4 class="fw-bold my-3">Kualitas Terbaik</h4>
                    <p class="text-muted">Kami hanya menggunakan material pilihan yang telah melewati proses seleksi ketat untuk menjamin kekuatan dan daya tahan produk.</p>
                </div>
            </div>
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="p-4">
                    <i class="bi bi-rulers fs-1 text-dark"></i>
                    <h4 class="fw-bold my-3">Desain Kustom</h4>
                    <p class="text-muted">Setiap klien adalah unik. Kami bekerja sama dengan Anda untuk mewujudkan furnitur impian yang sesuai dengan gaya dan kebutuhan Anda.</p>
                </div>
            </div>
            <div class="col-12 col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="p-4">
                    <i class="bi bi-hand-thumbs-up fs-1 text-dark"></i>
                    <h4 class="fw-bold my-3">Sentuhan Tangan Ahli</h4>
                    <p class="text-muted">Dikerjakan oleh para pengrajin berpengalaman, setiap detail furnitur kami mendapatkan perhatian penuh untuk hasil akhir yang sempurna.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="container py-5">
    <h2 class="text-center section-title" data-aos="fade-up">Kenali Tim Kami</h2>
    <div class="row g-4 justify-content-center">
        <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="card team-card border-0 text-center shadow-sm">
                <img src="https://images.pexels.com/photos/834863/pexels-photo-834863.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Founder">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Rizky Bachtiar</h5>
                    <p class="card-text text-muted">Founder & Lead Craftsman</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="card team-card border-0 text-center shadow-sm">
                <img src="https://images.pexels.com/photos/3769747/pexels-photo-3769747.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Customer Relations">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Dian Lestari</h5>
                    <p class="card-text text-muted">Customer Relations</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 text-center cta-section my-4" data-aos="fade-up">
    <div class="container">
        <h2 class="section-title">Siap Berkolaborasi?</h2>
        <p class="lead mb-4">Mari wujudkan ruang impian Anda bersama kami.</p>
        <a href="<?= base_url('/contact'); ?>" class="btn btn-dark btn-lg fw-bold">Hubungi Kami</a>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('page_scripts') ?>
<style>
    .about-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/1034584/pexels-photo-1034584.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1') center center/cover no-repeat;
        height: 60vh;
        min-height: 400px;
    }

    /* --- Timeline Styling --- */
    .timeline {
        position: relative;
        max-width: 700px;
        margin: 0 auto;
    }

    .timeline::after {
        content: '';
        position: absolute;
        width: 4px;
        background-color: #E0C9A6;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -2px;
    }

    .timeline-item {
        padding: 10px 40px;
        position: relative;
        background-color: inherit;
        width: 50%;
    }

    .timeline-item:nth-child(odd) {
        left: 0;
    }

    .timeline-item:nth-child(even) {
        left: 50%;
    }

    .timeline-dot {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        right: -8px;
        background-color: white;
        border: 4px solid #E0C9A6;
        top: 28px;
        border-radius: 50%;
        z-index: 1;
    }

    .timeline-item:nth-child(even) .timeline-dot {
        left: -8px;
    }

    .timeline-content {
        padding: 20px 30px;
        background-color: white;
        position: relative;
        border-radius: 6px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }

    .timeline-item:nth-child(even) .timeline-content {
        text-align: right;
    }

    /* --- Team Card Styling --- */
    .team-card img {
        aspect-ratio: 1/1;
        object-fit: cover;
    }

    /* Responsive untuk Timeline */
    @media (max-width: 767.98px) {
        .timeline::after {
            left: 20px;
        }

        .timeline-item {
            width: 100%;
            padding-left: 50px;
            padding-right: 15px;
        }

        .timeline-item:nth-child(even),
        .timeline-item:nth-child(odd) {
            left: 0;
        }

        .timeline-dot {
            left: 12px;
        }

        .timeline-item:nth-child(even) .timeline-content,
        .timeline-item:nth-child(odd) .timeline-content {
            text-align: left;
        }
    }
</style>
<?= $this->endSection() ?>