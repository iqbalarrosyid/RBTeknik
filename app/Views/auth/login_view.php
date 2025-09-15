<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale-1">
    <title>Login Admin - RB Teknik</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .fw-semibold,
        .btn {
            font-family: 'Montserrat', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-4 p-md-5">

                <div class="text-center mb-4">
                    <img src="<?= base_url('favicon.png') ?>" alt="RB Teknik Logo" style="height: 50px;">
                </div>

                <h3 class="text-center fw-bold mb-2">Admin Panel Login</h3>
                <p class="text-center text-muted mb-4">Selamat datang kembali, silakan masuk.</p>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <div>
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('/login') ?>">
                    <?= csrf_field() ?>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>

                    <div class="input-group mb-4">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark btn-lg fw-semibold">Login</button>
                    </div>

                </form>

                <div class="text-center mt-4">
                    <a href="<?= base_url('/') ?>" class="text-decoration-none text-muted">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Website
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>