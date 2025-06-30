<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
                        <li class="breadcrumb-item active">Detail Pesanan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <!-- Detail Pesanan -->
            <?php if ($this->session->flashdata('message')) : ?>
                <?= $this->session->flashdata('message'); ?>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Pesanan #<?= $pesanan['id_pesanan'] ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Informasi Pelanggan</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">Nama Pelanggan</th>
                                    <td><?= $pesanan['nama_pelanggan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?= $pesanan['email'] ?></td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td><?= $pesanan['telp_pelanggan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>
                                        <?= $pesanan['alamat'] ?><br>
                                        <?= $pesanan['kota'] ?>, <?= $pesanan['provinsi'] ?><br>
                                        Kode Pos: <?= $pesanan['kode_pos'] ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Detail Pesanan</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">ID Pesanan</th>
                                    <td>#<?= $pesanan['id_pesanan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pesanan</th>
                                    <td><?= date('d F Y H:i', strtotime($pesanan['tanggal_pesanan'])) ?></td>
                                </tr>
                                <tr>
                                    <th>Total Pesanan</th>
                                    <td>Rp <?= number_format($pesanan['total_pesanan'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <th>Status Pesanan</th>
                                    <td>
                                        <form action="<?= base_url('admin/pesanan/update_status') ?>" method="post">
                                            <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan'] ?>">
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                <option value="pending" <?= $pesanan['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                <option value="diproses" <?= $pesanan['status'] == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                                <option value="dikirim" <?= $pesanan['status'] == 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
                                                <option value="selesai" <?= $pesanan['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                                <option value="dibatalkan" <?= $pesanan['status'] == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4>Informasi Pembayaran</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">ID Pembayaran</th>
                                    <td><?= $pesanan['pembayaran']['id_pembayaran'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pembayaran</th>
                                    <td>
                                        <?= isset($pesanan['pembayaran']['tanggal_pembayaran']) ? date('d F Y H:i', strtotime($pesanan['pembayaran']['tanggal_pembayaran'])) : '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Bayar</th>
                                    <td>Rp <?= isset($pesanan['pembayaran']['total_bayar']) ? number_format($pesanan['pembayaran']['total_bayar'], 0, ',', '.') : '-' ?></td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td><?= isset($pesanan['pembayaran']['status']) ? ucfirst($pesanan['pembayaran']['status']) : 'Belum Melakukan Pembayaran' ?></td>
                                </tr>
                                <tr>
                                    <th>Bukti Pembayaran</th>
                                    <td>
                                        <?php if (!empty($pesanan['pembayaran']['bukti_pembayaran'])): ?>
                                            <img src="<?= base_url('uploads/bukti-pembayaran/' . $pesanan['pembayaran']['bukti_pembayaran']) ?>" alt="Bukti Pembayaran" class="img-fluid" style="max-width: 200px;">
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>Produk yang Dipesan</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th width="15%">Harga Satuan</th>
                                        <th width="10%">Jumlah</th>
                                        <th width="15%">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pesanan['list_produk'] as $produk): ?>
                                        <tr>
                                            <td>
                                                <strong><?= $produk['pd_nama'] ?></strong><br>
                                                (ID Produk: <?= $produk['produk_id'] ?>)
                                            </td>
                                            <td>Rp <?= number_format($produk['harga_saat_pembelian'], 0, ',', '.') ?></td>
                                            <td><?= $produk['jumlah'] ?></td>
                                            <td>Rp <?= number_format($produk['harga_saat_pembelian'] * $produk['jumlah'], 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">Total Pesanan</th>
                                        <th>Rp <?= number_format($pesanan['total_pesanan'], 0, ',', '.') ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="<?= base_url('admin/pesanan') ?>" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>