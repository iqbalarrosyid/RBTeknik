<!-- app/Views/layouts/admin.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Admin Panel - RB Teknik 37') ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .fw-semibold,
        .btn,
        .navbar-brand {
            font-family: 'Montserrat', sans-serif;
        }

        .navbar-dark {
            background-color: #343a40;
        }

        .navbar-dark .nav-link {
            color: #adb5bd;
        }

        .navbar-dark .nav-link.active,
        .navbar-dark .nav-link:hover {
            color: #fff;
        }

        .content-wrapper {
            padding: 1rem;
        }

        .blog-thumb {
            max-width: 80px;
            max-height: 80px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .truncate-text {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: inline-block;
            vertical-align: middle;
        }

        form.d-inline {
            display: inline;
            margin: 0;
            padding: 0;
        }

        .btn-action {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .btn-action i {
            pointer-events: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="<?= base_url('admin'); ?>">
                <i class="bi bi-speedometer2 me-1"></i> Admin Panel
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#adminNavbar"
                aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="adminNavbar">
                <?php
                $uri = service('uri');
                $segment2 = $uri->getSegment(2) ?? '';
                $isProduct = ($segment2 === '' || $segment2 === 'product');
                $isBlog = ($segment2 === 'blog');
                ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $isProduct ? 'active' : '' ?>" href="<?= base_url('admin'); ?>">
                            <i class="bi bi-box-seam me-1"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $isBlog ? 'active' : '' ?>" href="<?= base_url('admin/blog'); ?>">
                            <i class="bi bi-journal-text me-1"></i> Blog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?= base_url('logout'); ?>">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="content-wrapper">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Bootstrap Bundle (harus pakai bundle, jangan yang tanpa Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>