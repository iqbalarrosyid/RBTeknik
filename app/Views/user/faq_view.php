<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="container py-5">
    <h1 class="text-center section-title">Pertanyaan Umum (FAQ)</h1>
    <p class="lead text-center mb-5 col-md-8 mx-auto">
        Temukan jawaban atas pertanyaan yang paling sering diajukan mengenai produk, pemesanan, dan layanan kami.
    </p>
</section>

<section class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">

            <h4 class="fw-bold mb-3">Pemesanan & Pembayaran</h4>
            <div class="accordion" id="faqAccordionPemesanan">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            Bagaimana cara memesan produk?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordionPemesanan">
                        <div class="accordion-body text-secondary">
                            Anda bisa langsung menghubungi kami melalui tombol WhatsApp yang tersedia untuk konsultasi atau dengan cara menekan tombol pesan via WhatsApp pada produk yang ingin Anda pesan. Tim kami akan membantu Anda mulai dari pemilihan desain, material, hingga proses pemesanan. Proses umumnya meliputi: konsultasi > penawaran harga > pembayaran uang muka (DP) > proses produksi > pelunasan > pengiriman.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            Apa saja metode pembayaran yang diterima?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordionPemesanan">
                        <div class="accordion-body text-secondary">
                            Saat ini kami menerima pembayaran melalui transfer bank. Nomor rekening akan diinformasikan oleh tim kami saat proses penawaran harga.
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            <h4 class="fw-bold mb-3">Produk & Kustomisasi</h4>
            <div class="accordion" id="faqAccordionProduk">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                            Apakah saya bisa memesan furnitur dengan desain kustom?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordionProduk">
                        <div class="accordion-body text-secondary">
                            Tentu saja. Kami sangat terbuka untuk pesanan kustom. Anda bisa memberikan kami gambar referensi, sketsa, atau sekadar ide, dan tim desainer kami akan membantu Anda untuk mewujudkannya menjadi produk nyata.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                            Berapa lama proses pengerjaan untuk pesanan kustom?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordionProduk">
                        <div class="accordion-body text-secondary">
                            Waktu pengerjaan bervariasi tergantung pada tingkat kerumitan desain dan antrian produksi. Rata-rata, proses pengerjaan memakan waktu antara 3 hingga 6 minggu setelah uang muka kami terima.
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            <h4 class="fw-bold mb-3">Pengiriman</h4>
            <div class="accordion" id="faqAccordionPengiriman">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                            Apakah melayani pengiriman ke luar kota?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#faqAccordionPengiriman">
                        <div class="accordion-body text-secondary">
                            Ya, kami melayani pengiriman ke seluruh wilayah di Indonesia. Kami bekerja sama dengan jasa ekspedisi kargo terpercaya yang sudah berpengalaman dalam mengirimkan barang-barang mebel.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="container py-5 my-4 text-center">
    <h2 class="fw-bold">Tidak Menemukan Jawaban?</h2>
    <p class="lead text-muted my-3">Tim kami siap membantu menjawab setiap pertanyaan Anda.</p>
    <a href="<?= base_url('/contact') ?>" class="btn btn-dark btn-lg fw-bold">Hubungi Kami Langsung</a>
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
        /* Warna aksen emas saat focus */
    }

    .accordion-item {
        border-radius: 0.375rem !important;
        border: 1px solid #dee2e6;
        margin-bottom: 1rem;
    }
</style>
<?= $this->endSection() ?>