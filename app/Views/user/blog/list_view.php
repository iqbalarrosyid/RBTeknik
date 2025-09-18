<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<section class="container py-5">
    <h1 class="text-center section-title">Blog Kami</h1>
    <p class="lead text-center mb-5">
        Temukan artikel, tips, dan berita terbaru seputar produk serta inspirasi desain dari kami.
    </p>

    <div class="p-4 mb-5 bg-white rounded-3 shadow-sm">
        <form method="get" action="<?= base_url('blog') ?>" class="d-md-flex justify-content-between align-items-center">

            <div class="input-group flex-grow-1 me-md-3 mb-3 mb-md-0">
                <span class="input-group-text bg-light border-0"><i class="bi bi-search"></i></span>
                <input type="search" name="search" class="form-control form-control-lg border-0 bg-light"
                    placeholder="Cari artikel..." value="<?= esc($search ?? '') ?>">
            </div>

            <div class="d-flex align-items-center flex-shrink-0">
                <label class="form-label me-2 mb-0 d-none d-md-inline">Urutkan:</label>
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="" <?= empty($sort) ? 'selected' : '' ?>>Paling Baru</option>
                    <option value="oldest" <?= ($sort ?? '') == 'oldest' ? 'selected' : '' ?>>Paling Lama</option>
                    <option value="az" <?= ($sort ?? '') == 'az' ? 'selected' : '' ?>>Judul A-Z</option>
                    <option value="za" <?= ($sort ?? '') == 'za' ? 'selected' : '' ?>>Judul Z-A</option>
                </select>
            </div>
        </form>
    </div>

    <?php if (!empty($blogs)): ?>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-4">
            <?php foreach ($blogs as $blog): ?>
                <div class="col">
                    <div class="card product-card h-100 border-0 overflow-hidden">
                        <div class="product-card-img-container">
                            <a href="<?= base_url('blog/' . $blog['id']) ?>">
                                <?php
                                // Menentukan gambar yang akan ditampilkan
                                $thumbnail = !empty($blog['thumbnail']) ? $blog['thumbnail'] : 'default.jpg';
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
                            <p class="card-text text-secondary mb-3 truncate-text mt-auto">
                                <?= word_limiter(strip_tags($blog['content']), 15) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <h4 class="text-muted">Artikel tidak ditemukan</h4>
            <p>Coba gunakan kata kunci pencarian yang lain.</p>
            <a href="<?= base_url('blog') ?>" class="btn btn-dark mt-3">Tampilkan Semua Artikel</a>
        </div>
    <?php endif; ?>

    <br>
    <div class="d-flex justify-content-center">
        <?= $pager->links('blogs', 'bootstrap_5_pagination') ?>
    </div>
</section>

<?= $this->endSection() ?>