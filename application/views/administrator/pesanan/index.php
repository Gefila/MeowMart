<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pesanan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
                        <li class="breadcrumb-item active">pesanan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
            <div class="card-body p-0 card">
                <?php if ($this->session->flashdata('message')) : ?>
                    <?= $this->session->flashdata('message'); ?>
                <?php endif; ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_pesanan as $p): ?>
                            <tr>
                                <td><?= $p['id_pesanan'] ?></td>
                                <td><?= $p['nama_pelanggan'] ?></td>
                                <td><?= indo_datetime($p['tanggal_pesanan']); ?></td>
                                <td>Rp. <?= number_format($p['total_pesanan'], 0, ',', '.') ?></td>
                                <td>
                                    <?php
                                    $status = $p['status'];
                                    $badgeClass = 'secondary';
                                    if ($status == 'pending') {
                                        $badgeClass = 'warning';
                                    } elseif ($status == 'selesai') {
                                        $badgeClass = 'success';
                                    } elseif ($status == 'diproses') {
                                        $badgeClass = 'info';
                                    } elseif ($status ==  'dikirim') {
                                        $badgeClass = 'primary';
                                    } elseif ($status == 'batal') {
                                        $badgeClass = 'danger';
                                    }
                                    ?>
                                    <span class="badge badge-<?= $badgeClass ?>">
                                        <?= ucfirst($status) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/pesanan/detail/' . $p['id_pesanan']) ?>" class="btn btn-info btn-sm">Detail</a>
                                    <a href="<?= base_url('admin/pesanan/cetak/' . $p['id_pesanan']) ?>" class="btn btn-success btn-sm" target="_blank">Cetak</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>