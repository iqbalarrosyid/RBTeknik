<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="container py-5">
    <div class="row align-items-center g-5 text-center">
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold section-title">Kisah di Balik Setiap Potongan Kayu</h1>
            <p class="lead text-secondary">
                Selamat datang di RB Teknik, tempat di mana seni bertemu dengan keahlian pertukangan. Kami percaya bahwa furnitur bukan hanya sekadar benda, melainkan bagian dari cerita dan kehangatan sebuah rumah.
            </p>
            <p class="text-secondary">
                Berawal dari kecintaan pada keindahan alami kayu dan dedikasi terhadap detail, kami berkomitmen untuk menciptakan karya yang tidak hanya fungsional, tetapi juga memiliki jiwa dan mampu bertahan melintasi generasi.
            </p>
        </div>

    </div>
</section>


<section class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center section-title">Filosofi Kami</h2>
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="p-4">
                    <i class="bi bi-gem fs-1 text-dark"></i>
                    <h4 class="fw-bold my-3">Kualitas Terbaik</h4>
                    <p class="text-muted">Kami hanya menggunakan material kayu pilihan yang telah melewati proses seleksi ketat untuk menjamin kekuatan dan daya tahan produk.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4">
                    <i class="bi bi-rulers fs-1 text-dark"></i>
                    <h4 class="fw-bold my-3">Desain Kustom</h4>
                    <p class="text-muted">Setiap klien adalah unik. Kami bekerja sama dengan Anda untuk mewujudkan furnitur impian yang sesuai dengan gaya dan kebutuhan Anda.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4">
                    <i class="bi bi-hand-thumbs-up fs-1 text-dark"></i>
                    <h4 class="fw-bold my-3">Sentuhan Tangan Ahli</h4>
                    <p class="text-muted">Dikerjakan oleh para pengrajin berpengalaman, setiap detail furnitur kami mendapatkan perhatian penuh untuk hasil akhir yang sempurna.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="container py-5 text-center">
    <h2 class="section-title">Dari Bengkel ke Rumah Anda</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <img src="https://images.pexels.com/photos/1297611/pexels-photo-1297611.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid rounded shadow-sm" alt="Proses pengerjaan furnitur">
        </div>
        <div class="col-md-4">
            <img src="https://images.pexels.com/photos/7147043/pexels-photo-7147043.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid rounded shadow-sm" alt="Detail sambungan kayu">
        </div>
        <div class="col-md-4">
            <img src="https://images.pexels.com/photos/6585758/pexels-photo-6585758.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="img-fluid rounded shadow-sm" alt="Furnitur di dalam ruangan">
        </div>
    </div>
</section>


<section class="py-5 text-center cta-section my-4">
    <div class="container">
        <h2 class="section-title">Lihat Karya Kami</h2>
        <p class="lead mb-4">Setiap produk memiliki ceritanya sendiri. Temukan potongan yang sempurna untuk Anda.</p>
        <a href="<?= base_url('/products'); ?>" class="btn btn-dark btn-lg fw-bold">Jelajahi Produk</a>
    </div>
</section>

<?= $this->endSection() ?>