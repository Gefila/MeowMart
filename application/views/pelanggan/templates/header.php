<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gefila Store</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> -->
    <link href="<?= base_url('assets/') ?>css/styles.css" rel="stylesheet" />
    <script src="<?= base_url('assets/') ?>plugins/fontawesome/js/all.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery-1.11.0.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>plugins/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>plugins/slick/slick-theme.css" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery-1.11.0.min.js"></script>
</head>

<!-- Tambahkan ini di <head> jika belum -->
<style>
    .navbar-modern {
        background: #f8f9fc;
        transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
    }

    .navbar-scrolled {
        background-color: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-modern .nav-link {
        color: #333 !important;
        font-weight: 500;
    }

    .navbar-modern .nav-link:hover {
        color: #0d6efd !important;
    }

    .navbar-modern .navbar-brand {
        font-weight: bold;
        color: #0d6efd !important;
    }

    .navbar-modern .dropdown-menu {
        border-radius: 10px;
        border: none;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .navbar-modern .active{
        color: #0d6efd !important;
        font-weight: bold;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbar = document.querySelector(".navbar");
        const addScrollEffect = () => {
            if (window.scrollY > 10) {
                navbar.classList.add("navbar-scrolled");
            } else {
                navbar.classList.remove("navbar-scrolled");
            }
        };

        addScrollEffect(); // Check on load
        window.addEventListener("scroll", addScrollEffect);
    });
</script>


<body class="sb-nav-fixed">

    <nav class="navbar navbar-expand-lg fixed-top navbar-modern">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">Gefila Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarEcom" aria-controls="navbarEcom" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarEcom">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= is_active('') ?>" href="<?= base_url() ?>"><i class="fas fa-home me-1"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= is_active('produk') ?>" href="<?= base_url('produk') ?>"><i class="fas fa-box-open me-1"></i> Produk</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= is_active('produk', 'kategori') ?>" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-th-large me-1"></i> Kategori
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($list_kategori as $kategori) : ?>
                                <li>
                                    <a class="dropdown-item" href="<?= base_url('produk/kategori/') . $kategori['id_kategori'] ?>">
                                        <?= $kategori['nama']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item <?= is_active('promo') ?>">
                        <a class="nav-link" href="<?= base_url('promo') ?>"><i class="fas fa-tags me-1"></i> Promo</a>
                    </li>
                </ul>

                <!-- Search Box -->
                <form class="d-flex me-3" role="search" action="<?= base_url('produk/cari') ?>" method="get">
                    <input class="form-control" name="q" type="search" placeholder="Cari produk..." aria-label="Search">
                </form>

                <!-- Cart & User -->
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= base_url('keranjang') ?>" class="btn btn-outline-secondary position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <?php if (!empty($keranjang_count)) : ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= $keranjang_count ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <?php if ($this->session->userdata('pelanggan_login') ?? false) : ?>
                        <div class="dropdown">
                            <a class="btn btn-outline-primary dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> Akun
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= base_url('profil') ?>">Profil</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('pesanan') ?>">Pesanan Saya</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php else : ?>
                        <a href="<?= base_url('login') ?>" class="btn btn-outline-primary">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                        <a href="<?= base_url('register') ?>" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i> Register
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <div style="margin-top: 5rem;"></div>