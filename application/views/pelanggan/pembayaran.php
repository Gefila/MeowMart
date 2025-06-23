<div class="container mt-5">
    <h2>Halaman Pembayaran</h2>
    <hr>

    <!-- Informasi Pesanan -->
    <h4>Informasi Pesanan</h4>
    <table class="table table-bordered">
        <tr>
            <th>ID Pesanan</th>
            <td><?= $pesanan['id_pesanan']; ?></td>
        </tr>
        <tr>
            <th>Tanggal Pesanan</th>
            <td><?= date('d M Y, H:i', strtotime($pesanan['tanggal_pesanan'])); ?></td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>Rp <?= number_format($pesanan['total_pesanan'], 0, ',', '.'); ?></td>
        </tr>
    </table>

    <!-- Daftar Produk -->
    <h4>Produk dalam Pesanan</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produk as $item): ?>
                <tr>
                    <td>
                        <?php if ($item['gambar']): ?>
                            <img src="<?= $item['gambar']; ?>" alt="<?= $item['nama_produk']; ?>" width="100">
                        <?php else: ?>
                            <span>Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $item['nama_produk']; ?></td>
                    <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                    <td><?= $item['jumlah']; ?></td>
                    <td>Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Bagian Pembayaran -->
    <h4>Status Pembayaran</h4>
    <?php if ($pembayaran): ?>
        <div class="alert alert-info">
            <p><strong>Status: </strong><?= ucfirst($pembayaran['status']); ?></p>
            <p><strong>Tanggal Pembayaran: </strong><?= date('d M Y, H:i', strtotime($pembayaran['tanggal_pembayaran'])); ?></p>
            <p><strong>Total Dibayar: </strong>Rp <?= number_format($pembayaran['total_bayar'], 0, ',', '.'); ?></p>
            <p><strong>Bukti Pembayaran: </strong></p>
            <img src="<?= base_url($pembayaran['bukti_pembayaran']); ?>" alt="Bukti Pembayaran" width="300">
        </div>
    <?php else: ?>
        <form action="<?= base_url('pembayaran/bayar') ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan']; ?>">
            <div class="form-group mb-3">
                <label for="bukti_pembayaran">Unggah Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
        </form>
    <?php endif; ?>
</div>
