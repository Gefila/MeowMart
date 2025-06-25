<!DOCTYPE html>
<html>
<head>
    <title>Cetak Pesanan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        h3, h4 { margin: 0; }
        .text-right { text-align: right; }
    </style>
</head>
<body onload="window.print()">
    <h3>Nota Pesanan</h3>
    <p><strong>ID Pesanan:</strong> <?= $pesanan['id_pesanan'] ?></p>
    <p><strong>Nama Pelanggan:</strong> <?= htmlspecialchars($pesanan['nama_pelanggan']) ?></p>
    <p><strong>Alamat:</strong> <?= htmlspecialchars($pesanan['alamat']) ?></p>
    <p><strong>Tanggal Pesanan:</strong> <?= date('d M Y', strtotime($pesanan['tanggal_pesanan'])) ?></p>
    <p><strong>Status:</strong> <?= $pesanan['status'] ?></p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pesanan['produk'] as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['nama_produk']) ?></td>
                <td>Rp<?= number_format($p['harga'], 0, ',', '.') ?></td>
                <td><?= $p['jumlah'] ?></td>
                <td>Rp<?= number_format($p['subtotal'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan="3" class="text-right">Total</th>
                <th>Rp<?= number_format($pesanan['total'], 0, ',', '.') ?></th>
            </tr>
        </tbody>
    </table>

    <p style="margin-top: 40px;">Terima kasih telah berbelanja!</p>
</body>
</html>
