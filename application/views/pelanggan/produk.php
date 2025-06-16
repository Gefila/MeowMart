<!-- Style Khusus -->
<style>
    .produk-card {
        position: relative;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        border-radius: 0.75rem;
        /* Rounded semua sudut */
        overflow: hidden;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .produk-card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        /* Efek shadow saat hover */
        transform: translateY(-3px);
        border-color: #007bff;
    }

    .diskon {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 2;
    }

    .produk-img {
        object-fit: cover;
        height: 200px;
        width: 100%;
    }

    .text-truncate-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>

<?php if ($this->session->flashdata('message')): ?>
    <?= $this->session->flashdata('message'); ?>
<?php endif; ?>

<div class="container mb-4">
    <div class="row mb-3">

        <div class="col text-start">
            <?php if (isset($kategori)): ?>
                <h5 class="text-muted"><?= $kategori['nama'] ?></h5>
            <?php else: ?>
                <h5 class="text-muted">Semua Produk</h5>
            <?php endif; ?>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        <?php foreach ($list_produk as $key => $value): ?>
            <?php
            $gambar = $gambar_model->get_by_produk_id($value['id_produk']);
            if (empty($gambar)) {
                $gambar = [['nama_gambar' => 'image-placeholder.jpg']];
            }
            $link_detail = base_url('produk/') . $value['id_produk'];
            ?>
            <div class="col d-flex">
                <a href="<?= $link_detail ?>" class="produk-card card h-100 w-100 d-flex flex-column">
                    <?php if (!empty($value['nama_diskon']) && !empty($value['jumlah_diskon'])): ?>
                        <div class="diskon">
                            <span class="badge bg-danger"><?= $value['nama_diskon'] . " " . $value['jumlah_diskon'] . "%" ?></span>
                        </div>
                    <?php endif; ?>
                    <img src="<?= base_url('uploads/produk/') . $gambar[0]['nama_gambar']; ?>" alt="Gambar Produk" class="produk-img">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title text-truncate-2 mb-2"><?= $value['pd_nama'] ?></h6>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="harga d-flex align-items-baseline" style="color: #333;">
                                    <small class="me-1">Rp</small>
                                    <?php if (!empty($value['harga_akhir']) && $value['harga_akhir'] < $value['harga']): ?>
                                        <h6 class="mb-0 me-2 text-muted" style="text-decoration: line-through;">
                                            <?= number_format($value['harga']) ?>
                                        </h6>
                                        <h6 class="mb-0 text-danger">
                                            <?= number_format($value['harga_akhir']) ?>
                                        </h6>
                                    <?php else: ?>
                                        <h6 class="mb-0"><?= number_format($value['harga']) ?></h6>
                                    <?php endif; ?>
                                </div>
                                <small class="text-muted">2 terjual</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="container mt-4 text-center">
    <a type="button" class="btn btn-outline-primary" href="<?= base_url('produk'); ?>">Lihat Semua Produk</a>
</div>