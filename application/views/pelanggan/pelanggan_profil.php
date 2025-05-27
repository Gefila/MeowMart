<div class="container mt-5">
    <h2 class="mb-4">Profil Pelanggan</h2>

    <?php if ($this->session->flashdata('sukses')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('sukses') ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($data_pelanggan['email']) ?></td>
                </tr>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td><?= htmlspecialchars($data_pelanggan['nama_pelanggan']) ?></td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td><?= htmlspecialchars($data_pelanggan['telp_pelanggan']) ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= htmlspecialchars($data_pelanggan['alamat']) ?></td>
                </tr>
                <tr>
                    <th>Kota</th>
                    <td><?= htmlspecialchars($data_pelanggan['kota']) ?></td>
                </tr>
                <tr>
                    <th>Kode Pos</th>
                    <td><?= htmlspecialchars($data_pelanggan['kode_pos']) ?></td>
                </tr>
                <tr>
                    <th>Provinsi</th>
                    <td><?= htmlspecialchars($data_pelanggan['provinsi']) ?></td>
                </tr>
            </table>

            <a href="<?= base_url('profil/ubah') ?>" class="btn btn-primary mt-3">Edit Profil</a>
        </div>
    </div>
</div>