<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Elegan Furnitur - RB Teknik') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* --- General & Typography --- */
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f8f9fa;
            color: #495057;
            padding-top: 90px;
            /* Disesuaikan dengan tinggi navbar */
        }

        .section-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: #E0C9A6;
        }

        /* --- Navigation (Navbar) --- */
        .navbar {
            background-color: transparent;
            transition: background-color 0.4s ease-out, box-shadow 0.4s ease-out;
        }

        .navbar.scrolled {
            background-color: #ffffff !important;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .navbar .nav-link {
            font-family: 'Montserrat', sans-serif;
            font-weight: 500;
            color: #495057;
            position: relative;
        }

        .navbar .nav-link:hover {
            color: #000000;
        }

        .navbar .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background-color: #E0C9A6;
        }

        .navbar-toggler {
            border: none !important;
        }

        .navbar-toggler:focus {
            box-shadow: none !important;
        }

        /* Ganti seluruh blok @media Anda dengan ini */

        /* --- Mobile Navigation Overlay --- */
        @media (max-width: 991.98px) {

            /* Targetkan .navbar-collapse saat sedang transisi (collapsing) dan saat sudah tampil (show) */
            .navbar-collapse.show,
            .navbar-collapse.collapsing {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                /* Menggunakan 100% lebih aman dari 100vw */
                height: 100%;
                /* Menggunakan 100% lebih aman dari 100vh */
                background: rgba(255, 255, 255, 0.98);
                /* Latar sedikit transparan + efek blur */
                backdrop-filter: blur(5px);
                -webkit-backdrop-filter: blur(5px);
                z-index: 1050;

                /* Menengahkan semua item menu di layar */
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            /* Sisa styling di bawah ini tetap sama, pastikan ada */
            .navbar-collapse .navbar-nav {
                width: 100%;
                flex-direction: column;
            }

            .navbar-collapse .nav-item {
                margin: 1rem 0;
            }

            .navbar-collapse .nav-link {
                font-size: 1.5rem;
                font-weight: bold;
            }

            .navbar-collapse .btn {
                font-size: 1.2rem;
                padding: 0.75rem 2rem;
            }

            .navbar-collapse .nav-link.active::after {
                display: none;
            }

            .btn-close-overlay {
                position: absolute;
                top: 2rem;
                right: 2rem;
                font-size: 2rem;
                color: #000;
                background: none;
                border: none;
                padding: 0;
                z-index: 1051;
            }
        }

        /* --- Components (Cards, Buttons, etc.) --- */
        .product-card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .product-card .card-img-top {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .btn-custom {
            background-color: #343a40;
            color: white;
            border: 2px solid #343a40;
            padding: 12px 30px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #ffffff;
            color: #343a40;
        }

        /* --- Page Sections & Footer --- */
        .footer {
            background-color: #ffffff;
        }

        .social-icons a {
            color: #495057;
            font-size: 1.25rem;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #212529;
        }

        /* --- Floating Widgets --- */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            font-size: 30px;
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.25);
            z-index: 1000;
            transition: transform 0.2s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            color: #FFF;
        }
    </style>
</head>

<body>

    <nav id="mainNavbar" class="navbar navbar-expand-lg navbar-light fixed-top py-3">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold fs-4" href="<?= base_url('/'); ?>">RB Teknik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                $uri = service('uri');
                $current_page = $uri->getSegment(1);
                ?>
                <button class="btn-close-overlay d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item mx-2"><a class="nav-link <?= ($current_page == '') ? 'active' : '' ?>" href="<?= base_url('/'); ?>">Home</a></li>
                    <li class="nav-item mx-2"><a class="nav-link <?= ($current_page == 'about') ? 'active' : '' ?>" href="<?= base_url('/about'); ?>">About</a></li>
                    <li class="nav-item mx-2"><a class="nav-link <?= ($current_page == 'products' || $current_page == 'product') ? 'active' : '' ?>" href="<?= base_url('/products'); ?>">Products</a></li>
                    <li class="nav-item ms-3"><a class="btn btn-dark rounded-pill px-4" href="<?= base_url('/contact'); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="footer text-center py-4 mt-5 border-top">
        <div class="container">
            <div class="social-icons mb-3">
                <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
            </div>
            <p class="text-muted mb-0">&copy; <?= date('Y'); ?> Elegan Furnitur - RB Teknik. All Rights Reserved.</p>
        </div>
    </footer>

    <?php
    $pesan_whatsapp = "Halo, saya tertarik dengan produk furnitur dari RB Teknik. Bisa minta informasi lebih lanjut?";
    ?>
    <a href="https://wa.me/6281234567890?text=<?= urlencode($pesan_whatsapp) ?>" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Chat di WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mainNavbar = document.getElementById('mainNavbar');
            const navCollapse = document.getElementById('navbarNav');
            const body = document.body;

            if (mainNavbar && navCollapse) {
                const handleNavbarState = () => {
                    const isScrolled = window.scrollY > 50;
                    const isMenuOpen = navCollapse.classList.contains('show');
                    if (isScrolled || isMenuOpen) {
                        mainNavbar.classList.add('scrolled');
                    } else {
                        mainNavbar.classList.remove('scrolled');
                    }
                };
                window.addEventListener('scroll', handleNavbarState);
                navCollapse.addEventListener('shown.bs.collapse', function() {
                    handleNavbarState();
                    body.style.overflow = 'hidden';
                });
                navCollapse.addEventListener('hidden.bs.collapse', function() {
                    handleNavbarState();
                    body.style.overflow = 'auto';
                });
            } else {
                console.error("Elemen navbar (mainNavbar) atau menu (navbarNav) tidak ditemukan.");
            }
        });
    </script>

    <?= $this->renderSection('page_scripts') ?>

</body>

</html>