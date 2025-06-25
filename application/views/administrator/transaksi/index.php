<div class="container mt-4">
    <h3>Daftar Transaksi</h3>

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Tanggal Pesanan</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transaksi as $t): ?>
                <tr>
                    <td><?= htmlspecialchars($t['nama_pelanggan']) ?></td>
                    <td><?= date('d M Y', strtotime($t['tanggal_pesanan'])) ?></td>
                    <td><?= $t['produk'] ?></td>
                    <td><?= $t['harga'] ?></td>
                    <td><?= $t['jumlah'] ?></td>
                    <td><?= $t['subtotal'] ?></td>
                    <td><?= htmlspecialchars($t['status']) ?></td>
                    <td>
                        <a href="<?= base_url('transaksi/detail/' . $t['id_pesanan']) ?>" class="btn btn-sm btn-primary">Lihat</a>
                        <a href="<?= base_url('admin/transaksi/cetak/' . $t['id_pesanan']) ?>" target="_blank" class="btn btn-sm btn-secondary">Cetak</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>