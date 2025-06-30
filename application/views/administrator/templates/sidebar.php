<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" id="sidebar">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin') ?>" class="brand-link">
        <img src="<?= base_url('assets/') ?>dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Gefila Store</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/') ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $this->session->userdata('full_name'); ?></a>
            </div>
        </div>

        <!-- Search Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar"><i class="fas fa-search fa-fw"></i></button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('admin') ?>" class="nav-link <?= is_active_sidebar('admin') ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Master -->
                <li class="nav-item <?= is_active_sidebar('admin', 'kategori') || is_active_sidebar('admin', 'produk') || is_active_sidebar('admin', 'diskon') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= is_active_sidebar('admin', 'kategori') || is_active_sidebar('admin', 'produk') || is_active_sidebar('admin', 'diskon') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Master <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/kategori') ?>" class="nav-link <?= is_active_sidebar('admin', 'kategori') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/produk') ?>" class="nav-link <?= is_active_sidebar('admin', 'produk') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/diskon') ?>" class="nav-link <?= is_active_sidebar('admin', 'diskon') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Diskon</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Transaksi -->
                <li class="nav-item <?= is_active_sidebar('admin', 'pesanan') || is_active_sidebar('admin', 'pembayaran') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= is_active_sidebar('admin', 'pesanan') || is_active_sidebar('admin', 'pembayaran') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Transaksi <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/pesanan') ?>" class="nav-link <?= is_active_sidebar('admin', 'pesanan') ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pesanan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="<?= base_url('admin/logout') ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
