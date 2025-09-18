<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="container py-5">
    <div data-aos="fade-up">
        <h1 class="text-center section-title">Pertanyaan Umum (FAQ)</h1>
        <p class="lead text-center mb-5 col-md-8 mx-auto">
            Temukan jawaban atas pertanyaan yang paling sering diajukan mengenai produk, pemesanan, dan layanan kami.
        </p>
    </div>
</section>

<section class="container">
    <div class="row g-5">

        <div class="col-lg-4" data-aos="fade-right">
            <div class="faq-nav-wrapper p-4 bg-white rounded shadow-sm">
                <h4 class="fw-bold mb-3"><i class="bi bi-tag-fill me-2"></i> Kategori Pertanyaan</h4>
                <div class="list-group" id="faq-nav">
                    <a class="list-group-item list-group-item-action active" href="#faq-pemesanan">
                        Pemesanan & Pembayaran
                    </a>
                    <a class="list-group-item list-group-item-action" href="#faq-produk">
                        Produk & Kustomisasi
                    </a>
                    <a class="list-group-item list-group-item-action" href="#faq-pengiriman">
                        Pengiriman & Garansi
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8" data-aos="fade-left" data-aos-delay="200">
            <div id="faq-pemesanan" class="faq-category">
                <h3 class="fw-bold mb-4">Pemesanan & Pembayaran</h3>
                <div class="accordion" id="faqAccordionPemesanan">
                    <div class="accordion-item">
                        <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">Bagaimana cara memesan produk?</button></h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordionPemesanan">
                            <div class="accordion-body text-secondary">
                                Anda bisa langsung menghubungi kami melalui tombol WhatsApp yang tersedia untuk konsultasi atau dengan cara menekan tombol "Pesan via WhatsApp" pada halaman detail produk yang ingin Anda pesan. Tim kami akan membantu Anda mulai dari pemilihan desain, material, hingga proses pemesanan. Proses umumnya meliputi: konsultasi > penawaran harga > pembayaran uang muka (DP) > proses produksi > pelunasan > pengiriman.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">Apa saja metode pembayaran yang diterima?</button></h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordionPemesanan">
                            <div class="accordion-body text-secondary">
                                Saat ini kami menerima pembayaran melalui transfer antar bank (BCA, Mandiri, BRI). Nomor rekening resmi akan diinformasikan oleh tim penjualan kami saat proses penawaran harga untuk menjamin keamanan transaksi Anda.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="faq-produk" class="faq-category mt-5">
                <h3 class="fw-bold mb-4">Produk & Kustomisasi</h3>
                <div class="accordion" id="faqAccordionProduk">
                    <div class="accordion-item">
                        <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">Apakah saya bisa memesan furnitur dengan desain kustom?</button></h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordionProduk">
                            <div class="accordion-body text-secondary">
                                Tentu saja. Kami sangat terbuka untuk pesanan kustom, itu adalah spesialisasi kami. Anda bisa memberikan kami gambar referensi, sketsa, atau sekadar ide, dan tim desainer kami akan membantu Anda untuk mewujudkannya menjadi produk nyata yang sesuai dengan keinginan Anda.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">Berapa lama proses pengerjaan untuk pesanan kustom?</button></h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordionProduk">
                            <div class="accordion-body text-secondary">
                                Waktu pengerjaan bervariasi tergantung pada tingkat kerumitan desain dan antrian produksi. Rata-rata, proses pengerjaan memakan waktu antara 3 hingga 6 minggu setelah konfirmasi desain dan pembayaran uang muka (DP) kami terima.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="faq-pengiriman" class="faq-category mt-5">
                <h3 class="fw-bold mb-4">Pengiriman & Garansi</h3>
                <div class="accordion" id="faqAccordionPengiriman">
                    <div class="accordion-item">
                        <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">Apakah melayani pengiriman ke luar kota?</button></h2>
                        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordionPengiriman">
                            <div class="accordion-body text-secondary">
                                Ya, kami melayani pengiriman ke seluruh wilayah di Indonesia. Kami bekerja sama dengan jasa ekspedisi kargo terpercaya yang sudah berpengalaman dalam mengirimkan barang-barang mebel untuk memastikan produk sampai di tujuan dengan aman.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">Apakah ada garansi untuk produk?</button></h2>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#faqAccordionPengiriman">
                            <div class="accordion-body text-secondary">
                                Kami memberikan garansi konstruksi selama 1 tahun untuk semua produk kami. Garansi ini mencakup perbaikan pada kerusakan struktural. Garansi tidak mencakup kerusakan akibat pemakaian normal, kelalaian, atau faktor eksternal lainnya seperti kelembaban ekstrem atau hama.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="container py-5 my-4 text-center" data-aos="fade-up">
    <div class="p-5 bg-white rounded shadow-sm">
        <h2 class="fw-bold">Tidak Menemukan Jawaban?</h2>
        <p class="lead text-muted my-3">Tim kami siap membantu menjawab setiap pertanyaan Anda secara langsung.</p>
        <a href="<?= base_url('/contact') ?>" class="btn btn-dark btn-lg fw-bold">Hubungi Kami Langsung</a>
    </div>
</section>

<?= $this->endSection() ?>


<?= $this->section('page_scripts') ?>
<style>
    /* Kustomisasi tampilan akordeon agar lebih elegan */
    .accordion-button {
        font-weight: 600;
        color: #212529;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f8f9fa;
        color: #212529;
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .125);
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(224, 201, 166, 0.3);
    }

    .accordion-item {
        border-radius: 0.5rem !important;
        border: 1px solid #dee2e6;
        margin-bottom: 1rem;
        background-color: #fff;
    }

    /* Styling untuk Navigasi Kategori FAQ */
    .faq-nav-wrapper {
        position: -webkit-sticky;
        /* Safari */
        position: sticky;
        top: 120px;
        /* Jarak dari atas (setelah navbar) */
    }

    .list-group-item.active {
        background-color: #212529;
        border-color: #212529;
    }

    .list-group-item-action:hover,
    .list-group-item-action:focus {
        background-color: #f8f9fa;
        color: #212529;
    }
</style>

<script>
    // Script untuk membuat navigasi kategori aktif saat di-scroll
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.faq-category');
        const navLinks = document.querySelectorAll('#faq-nav .list-group-item');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href').substring(1) === entry.target.id) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }, {
            threshold: 0.7
        });

        sections.forEach(section => {
            observer.observe(section);
        });
    });
</script>
<?= $this->endSection() ?>