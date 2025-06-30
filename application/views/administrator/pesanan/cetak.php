<!DOCTYPE html>
<html>

<head>
    <title>Cetak Invoice #<?= $pesanan['id_pesanan'] ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        .no-border td {
            border: none;
        }
    </style>
</head>

<body onload="window.print()">

    <h2>INVOICE PESANAN</h2>

    <table class="no-border">
        <tr>
            <td><strong>ID Pesanan:</strong> #<?= $pesanan['id_pesanan'] ?></td>
            <td><strong>Tanggal:</strong> <?= date('d F Y H:i', strtotime($pesanan['tanggal_pesanan'])) ?></td>
        </tr>
        <tr>
            <td colspan="2"><strong>Status:</strong> <?= ucfirst($pesanan['status']) ?></td>
        </tr>
    </table>

    <h4>Informasi Pelanggan</h4>
    <table>
        <tr>
            <th>Nama</th>
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
            <td><?= $pesanan['alamat'] ?>, <?= $pesanan['kota'] ?>, <?= $pesanan['provinsi'] ?> (<?= $pesanan['kode_pos'] ?>)</td>
        </tr>
    </table>

    <h4>Daftar Produk</h4>
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
            <?php foreach ($pesanan['list_produk'] as $produk): ?>
                <tr>
                    <td><?= $produk['pd_nama'] ?></td>
                    <td>Rp <?= number_format($produk['harga_saat_pembelian'], 0, ',', '.') ?></td>
                    <td><?= $produk['jumlah'] ?></td>
                    <td>Rp <?= number_format($produk['harga_saat_pembelian'] * $produk['jumlah'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total</th>
                <th>Rp <?= number_format($pesanan['total_pesanan'], 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>

    <h4>Informasi Pembayaran</h4>
    <table>
        <tr>
            <th>ID Pembayaran</th>
            <td><?= $pesanan['pembayaran']['id_pembayaran'] ?? '-' ?></td>
        </tr>
        <tr>
            <th>Total Bayar</th>
            <td>Rp <?= number_format($pesanan['pembayaran']['total_bayar'] ?? 0, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= ucfirst($pesanan['pembayaran']['status'] ?? '-') ?></td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td><?= isset($pesanan['pembayaran']['tanggal_pembayaran']) ? date('d F Y H:i', strtotime($pesanan['pembayaran']['tanggal_pembayaran'])) : '-' ?></td>
        </tr>
    </table>

</body>

</html>