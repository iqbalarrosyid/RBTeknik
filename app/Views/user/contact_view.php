<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="container py-5">
    <h1 class="text-center section-title">Hubungi Kami</h1>
    <p class="lead text-center mb-5 col-md-8 mx-auto">
        Kami siap membantu mewujudkan furnitur impian Anda. Silakan hubungi kami melalui informasi di bawah ini atau kirimkan pesan melalui formulir kontak.
    </p>
</section>

<div class="container">
    <div class="row g-5">

        <div class="col-lg-12">
            <div class="p-4 bg-white rounded shadow-sm h-100">
                <h4 class="fw-bold mb-4">Informasi Kontak</h4>

                <ul class="list-unstyled">
                    <li class="d-flex mb-3">
                        <i class="bi bi-geo-alt-fill fs-4 text-dark me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-0">Alamat Workshop</h6>
                            <p class="text-muted mb-0">Ngrancah, Sriharjo, Kec. Imogiri, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55782</p>
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="bi bi-telephone-fill fs-4 text-dark me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-0">Telepon / WhatsApp</h6>
                            <p class="text-muted mb-0">+62 838-9405-6521</p>
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="bi bi-envelope-fill fs-4 text-dark me-3"></i>
                        <div>
                            <h6 class="fw-bold mb-0">Email</h6>
                            <p class="text-muted mb-0">rbteknik@gmail.com</p>
                        </div>
                    </li>
                </ul>

                <hr class="my-4">

                <h4 class="fw-bold mb-3">Lokasi Kami</h4>
                <div class="ratio ratio-16x9 rounded overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3493.5798995072196!2d110.39245129999999!3d-7.9470379000000015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a54c51b8a637b%3A0x6e560ced467a1c8a!2sRatman%20taylor%20Ngrancah!5e1!3m2!1sid!2sid!4v1757914841817!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>