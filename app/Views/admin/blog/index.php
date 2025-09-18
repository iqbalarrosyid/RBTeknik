<?= $this->extend('layout/admintemplate') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <h2 class="fw-bold text-dark mb-0"><i class="bi bi-journal-text me-2"></i> Daftar Blog</h2>
        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/blog/create'); ?>" class="btn btn-dark fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Tambah Blog
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="get" action="<?= base_url('admin/blog'); ?>" class="d-md-flex justify-content-between align-items-center">
                <div class="input-group flex-grow-1 me-md-3 mb-3 mb-md-0">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul atau konten blog..." value="<?= esc($search ?? '') ?>">
                    <button class="btn btn-dark" type="submit" aria-label="Cari">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <div class="d-flex align-items-center flex-shrink-0">
                    <label for="sort" class="form-label me-2 mb-0 d-none d-md-inline">Urutkan:</label>
                    <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                        <option value="" <?= empty($sort) ? 'selected' : '' ?>>Paling Baru</option>
                        <option value="az" <?= ($sort ?? '') == 'az' ? 'selected' : '' ?>>Judul A-Z</option>
                        <option value="za" <?= ($sort ?? '') == 'za' ? 'selected' : '' ?>>Judul Z-A</option>
                        <option value="newest" <?= ($sort ?? '') == 'newest' ? 'selected' : '' ?>>Terbaru</option>
                        <option value="oldest" <?= ($sort ?? '') == 'oldest' ? 'selected' : '' ?>>Terlama</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Konten</th>
                            <th class="text-center">Thumbnail</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($blogs)): ?>
                            <?php foreach ($blogs as $blog): ?>
                                <tr>
                                    <td class="fw-semibold text-dark"><?= esc($blog['title']) ?></td>
                                    <td>
                                        <div class="truncate-text" title="<?= esc($blog['content']) ?>">
                                            <?= esc(strip_tags($blog['content'])) ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php if (!empty($blog['thumbnail'])): ?>
                                            <img src="<?= base_url('uploads/blog/' . $blog['thumbnail']) ?>" class="blog-thumb">
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d M Y', strtotime($blog['created_at'])) ?></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?= base_url('admin/blog/edit/' . $blog['id']); ?>"
                                                class="btn-action text-warning"
                                                data-bs-toggle="tooltip"
                                                title="Edit Blog">
                                                <i class="bi bi-pencil-square fs-5"></i>
                                            </a>
                                            <form action="<?= base_url('admin/blog/delete/' . $blog['id']); ?>"
                                                method="post"
                                                onsubmit="return confirm('Yakin hapus blog ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit"
                                                    class="btn-action text-danger"
                                                    data-bs-toggle="tooltip"
                                                    title="Hapus Blog">
                                                    <i class="bi bi-trash3-fill fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Blog tidak ditemukan.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="d-flex justify-content-center">
        <?= $pager->links('blogs', 'bootstrap_5_pagination') ?>
    </div>
</div>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function(el) {
        return new bootstrap.Tooltip(el)
    })
</script>
<?= $this->endSection() ?>