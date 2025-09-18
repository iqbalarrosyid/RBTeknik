<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Artikel Baru - Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f8f9fa;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .fw-semibold {
            font-family: 'Montserrat', sans-serif;
        }

        .form-label {
            font-weight: 600;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
        }

        #image-preview {
            margin-top: 1rem;
        }

        .preview-thumbnail {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 2px;
        }
    </style>
</head>

<body class="py-5">

    <div class="container">

        <div class="mb-4">
            <a href="<?= base_url('admin/blog'); ?>" class="text-decoration-none text-dark">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Blog
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header py-3">
                <h2 class="fw-bold mb-0"><i class="bi bi-plus-circle-fill me-2"></i> Tambah Artikel Baru</h2>
            </div>
            <div class="card-body p-4">

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <p class="fw-bold mb-2">Terjadi Kesalahan:</p>
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <form action="<?= base_url('admin/blog/store'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Artikel</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= old('title'); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Isi Artikel</label>
                        <textarea id="content" name="content" class="form-control" rows="10"><?= old('content'); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail Artikel</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                        <div id="image-preview"></div>
                    </div>

                    <div class="card-footer bg-white text-end border-0 pt-4 px-0">
                        <a href="<?= base_url('admin/blog'); ?>" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-dark fw-semibold">
                            <i class="bi bi-check-circle me-1"></i> Simpan Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- TinyMCE -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@7.6.1/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'lists link image table code',
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code',
            height: 300
        });

        // Preview thumbnail
        document.getElementById('thumbnail').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = '';
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('preview-thumbnail');
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>

</body>

</html>