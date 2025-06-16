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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample07">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('produk') ?>">Produk</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Kategori</a>
                        <ul class="dropdown-menu">
                            <?php foreach ($list_kategori as $kategori) : ?>
                                <li><a class="dropdown-item" href="<?= base_url('produk/kategori/') . $kategori['id_kategori'] ?>"><?= $kategori['nama']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>

                <form class="d-flex me-3" role="search">
                    <input class="form-control" type="search" placeholder="Cari produk..." aria-label="Search">
                </form>

                <div class="d-flex align-items-center gap-2">
                    <?php if ($this->session->userdata('pelanggan_login') ?? false) : ?>
                        <a href="<?= base_url() ?>profil" class="btn btn-outline-primary">Profil</a>
                        <a href="<?= base_url() ?>keranjang" class="btn btn-outline-secondary">Keranjang</a>
                        <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
                    <?php else : ?>
                        <a href="<?= base_url() ?>login" class="btn btn-outline-primary">Login</a>
                        <a href="<?= base_url('register') ?>" class="btn btn-primary">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <div style="margin-top: 5rem;"></div>