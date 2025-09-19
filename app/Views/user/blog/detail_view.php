<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9 text-center" data-aos="fade-up">
            <h1 class="display-5 fw-bold mb-3"><?= esc($blog['title']) ?></h1>
            <p class="text-muted mb-4">
                <span class="me-3"><i class="bi bi-person-fill me-1"></i> RB Teknik 37</span>
                <span><i class="bi bi-calendar-event me-1"></i> <?= date('d M Y', strtotime($blog['created_at'])) ?></span>
            </p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10 mb-5" data-aos="fade-up" data-aos-delay="200">
            <?php if (!empty($blog['thumbnail'])): ?>
                <img src="<?= base_url('uploads/blog/' . esc($blog['thumbnail'])) ?>" class="img-fluid rounded-3 shadow-sm w-100" alt="<?= esc($blog['title']) ?>" style="aspect-ratio: 16/9; object-fit: cover;">
            <?php endif; ?>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-2 d-none d-lg-block">
            <div class="social-share-sticky">
                <p class="fw-bold small text-muted">BAGIKAN:</p>
                <a href="https://api.whatsapp.com/send?text=<?= urlencode(esc($blog['title']) . ' ' . current_url()) ?>" target="_blank" class="d-block mb-3 fs-4 text-muted"><i class="bi bi-whatsapp"></i></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="d-block mb-3 fs-4 text-muted"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode(esc($blog['title'])) ?>" target="_blank" class="d-block mb-3 fs-4 text-muted"><i class="bi bi-twitter-x"></i></a>
                <a href="#" id="copyLinkBtn" class="d-block fs-4 text-muted" data-bs-toggle="tooltip" title="Salin Link"><i class="bi bi-link-45deg"></i></a>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="article-content">
                <?= $blog['content'] ?>
            </div>

            <div class="d-lg-none text-center my-4">
                <hr>
                <p class="fw-bold small text-muted mt-4">BAGIKAN ARTIKEL INI:</p>
                <a href="https://api.whatsapp.com/send?text=<?= urlencode(esc($blog['title']) . ' ' . current_url()) ?>" target="_blank" class="fs-4 text-muted me-3"><i class="bi bi-whatsapp"></i></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="fs-4 text-muted me-3"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode(esc($blog['title'])) ?>" target="_blank" class="fs-4 text-muted me-3"><i class="bi bi-twitter-x"></i></a>
                <a href="#" id="copyLinkBtnMobile" class="fs-4 text-muted"><i class="bi bi-link-45deg"></i></a>
            </div>

            <hr class="my-5">

            <div class="author-box d-flex align-items-center bg-white p-4 rounded-3 shadow-sm" data-aos="fade-up">
                <div>
                    <h5 class="fw-bold mb-0">Tim RB Teknik 37</h5>
                    <p class="text-muted mb-0">Pengrajin dan desainer furnitur dengan dedikasi tinggi pada kualitas dan detail, berbasis di Yogyakarta.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('page_scripts') ?>
<style>
    /* Styling untuk Konten Artikel */
    .article-content p {
        line-height: 1.7;
        margin-bottom: 1.25rem;
    }

    .article-content,
    .card-text,
    p {
        overflow-wrap: break-word;
        word-wrap: break-word;
        /* fallback untuk browser lama */
    }

    .article-content h2,
    .article-content h3 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 2rem 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .article-content blockquote {
        border-left: 4px solid #E0C9A6;
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #6c757d;
    }

    /* Styling untuk Tombol Share Sticky */
    .social-share-sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 130px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Tooltip untuk tombol Salin Link
        const copyBtn = document.getElementById('copyLinkBtn');
        if (copyBtn) {
            const tooltip = new bootstrap.Tooltip(copyBtn);
            copyBtn.addEventListener('click', function(e) {
                e.preventDefault();
                navigator.clipboard.writeText(window.location.href).then(() => {
                    // Beri feedback visual bahwa link telah disalin
                    copyBtn.setAttribute('data-bs-original-title', 'Disalin!');
                    tooltip.show();
                    setTimeout(() => {
                        tooltip.hide();
                        copyBtn.setAttribute('data-bs-original-title', 'Salin Link');
                    }, 2000);
                });
            });
        }
    });
</script>
<?= $this->endSection() ?>