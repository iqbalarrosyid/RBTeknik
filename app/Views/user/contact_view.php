<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="container py-5">
    <div class="row text-center">
        <div class="col-lg-8 mx-auto" data-aos="fade-up">
            <h1 class="section-title">Hubungi Kami</h1>
            <p class="lead">Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau ingin membuat pesanan kustom.</p>
        </div>
    </div>
    <div class="row g-4 text-center mt-5">
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="contact-info-card bg-white p-4 rounded shadow-sm h-100">
                <i class="bi bi-geo-alt-fill fs-1 text-dark"></i>
                <h4 class="fw-bold my-3">Alamat Workshop</h4>
                <p class="text-muted">
                    Ngrancah, Sriharjo, Kec. Imogiri, <br>
                    Kabupaten Bantul, DIY 55782
                </p>
            </div>
        </div>
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="contact-info-card bg-white p-4 rounded shadow-sm h-100">
                <i class="bi bi-telephone-fill fs-1 text-dark"></i>
                <h4 class="fw-bold my-3">Telepon & WhatsApp</h4>
                <p class="text-muted">+62 838-9405-6521</p>
            </div>
        </div>
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="contact-info-card bg-white p-4 rounded shadow-sm h-100">
                <i class="bi bi-envelope-fill fs-1 text-dark"></i>
                <h4 class="fw-bold my-3">Alamat Email</h4>
                <p class="text-muted">rbteknik@gmail.com</p>
            </div>
        </div>
    </div>
</section>


<section class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="section-title" data-aos="fade-up">Kirim Pesan Langsung</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 mx-auto" data-aos="fade-up" data-aos-delay="200">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                <form action="<?= base_url('contact/send') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6 mb-3"><input type="text" class="form-control" name="name" placeholder="Nama Anda" required></div>
                        <div class="col-md-6 mb-3"><input type="email" class="form-control" name="email" placeholder="Alamat Email" required></div>
                    </div>
                    <div class="mb-3"><input type="text" class="form-control" name="subject" placeholder="Subjek" required></div>
                    <div class="mb-3"><textarea class="form-control" name="message" rows="5" placeholder="Pesan Anda" required></textarea></div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark fw-bold px-5 py-2">Kirim Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="container-fluid p-0">
    <div class="ratio ratio-21x9" style="min-height: 350px; padding: 0 1rem;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3493.579944798068!2d110.38987100998682!3d-7.947032579134272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a54c51b8a637b%3A0x6e560ced467a1c8a!2sRatman%20taylor%20Ngrancah!5e1!3m2!1sid!2sid!4v1758205739548!5m2!1sid!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('page_scripts') ?>
<style>
    /* .contact-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/4393668/pexels-photo-4393668.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1') center center/cover no-repeat;
        height: 50vh;
        min-height: 350px;
    } */

    .contact-info-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact-info-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }
</style>
<?= $this->endSection() ?>