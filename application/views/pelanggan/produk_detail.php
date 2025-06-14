<!-- STYLE TAMBAHAN -->
<style>
    .image-produk {
        width: 100%;
        border-radius: 12px;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .image-nav {
        width: 100%;
        padding: 5%;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .image-nav:hover {
        transform: scale(1.05);
    }

    .produk-detail {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    .produk-detail h2 {
        font-weight: bold;
    }

    .produk-detail h5 {
        font-weight: 600;
    }

    .product-buttons button {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        border-radius: 8px;
        transition: 0.3s;
    }

    .product-buttons button:hover {
        box-shadow: 0 6px 16px rgba(0, 123, 255, 0.3);
    }

    .deskripsi {
        margin-top: 2rem;
    }

    .deskripsi h4 {
        font-size: 1.2rem;
        font-weight: 600;
    }

    .breadcrumb {
        background: none;
        padding: 0;
        margin-bottom: 0;
    }

    .slider-nav img {
        height: 80px;
        object-fit: cover;
    }

    .produk-header {
background: linear-gradient(135deg, #56ccf2, #2f80ed);

color: white;
        border-radius: 16px;
        padding: 2rem 1rem;
        text-align: center;
        margin-bottom: 2rem;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
    }

    .produk-header h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .produk-header .breadcrumb {
        background: transparent;
        margin: 0;
        padding: 0;
        justify-content: center;
    }

    .produk-header .breadcrumb a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
    }

    .produk-header .breadcrumb-item.active {
        color: #e0f7ff;
    }

    .produk-header .breadcrumb-item+.breadcrumb-item::before {
        color: #b0eaff;
    }
</style>

<!-- FLASH MESSAGE -->
<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- HEADER PRODUK -->
<div class="container mt-4">
    <div class="produk-header">
        <h1><?= $produk['pd_nama'] ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $kategori['nama'] ?></li>
            </ol>
        </nav>
    </div>
</div>

<!-- DETAIL PRODUK -->
<div class="container mb-5">
    <div class="row g-4">
        <!-- Gambar Produk -->
        <div class="col-md-6">
            <div class="product-slick mb-3">
                <?php if (!empty($list_gambar)): ?>
                    <?php foreach ($list_gambar as $gambar): ?>
                        <div>
                            <img src="<?= base_url('uploads/produk/') . ($gambar['nama_gambar'] ?? 'image-placeholder.jpg') ?>"
                                alt="<?= $produk['pd_nama'] ?>" class="image-produk img-fluid"
                                onerror="this.src='<?= base_url('uploads/produk/image-placeholder.jpg') ?>'">
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <div>
                        <img src="<?= base_url('uploads/produk/image-placeholder.jpg') ?>"
                            alt="<?= $produk['pd_nama'] ?>" class="image-produk img-fluid">
                    </div>
                <?php endif; ?>
            </div>

            <div class="slider-nav">
                <?php foreach ($list_gambar as $gambar): ?>
                    <div>
                        <img src="<?= base_url('uploads/produk/') . $gambar['nama_gambar'] ?>"
                            alt="" class="image-nav img-fluid">
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <!-- Informasi Produk -->
        <div class="col-md-6">
            <div class="produk-detail">
                <h2><?= $produk['pd_nama'] ?></h2>
                <div class="d-flex align-items-baseline mb-3" style="color: #333;">
                    <small class="me-1">Rp</small>
                    <?php if (!empty($produk['harga_akhir']) && $produk['harga_akhir'] < $produk['harga']): ?>
                        <h5 class="mb-0 me-2 text-muted" style="text-decoration: line-through;">
                            <?= number_format($produk['harga']) ?>
                        </h5>
                        <h5 class="mb-0 text-danger">
                            <?= number_format($produk['harga_akhir']) ?>
                        </h5>
                    <?php else: ?>
                        <h5 class="mb-0"><?= number_format($produk['harga']) ?></h5>
                    <?php endif; ?>
                </div>

                <p class="mb-1"><strong>ID Produk:</strong> <?= $produk['id_produk'] ?></p>
                <p class="mb-3"><strong>Stok:</strong> <?= $produk['stok'] ?></p>

                <form action="<?= base_url("keranjang/tambah") ?>" method="post">
                    <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Beli</label>
                        <input class="form-control" name="jumlah" type="number" value="1" min="1" required>
                    </div>
                    <div class="product-buttons">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-shopping-cart me-1"></i> Tambah ke Keranjang
                        </button>
                    </div>
                </form>

                <div class="deskripsi">
                    <h4>Deskripsi:</h4>
                    <p class="text-muted"><?= nl2br($produk['deskripsi']) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SLICK JS INIT -->
<script>
    $(document).ready(function() {
        $('.product-slick').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav',
        });

        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.product-slick',
            dots: false,
            centerMode: true,
            focusOnSelect: true
        });
    });
</script>