<div class="container mt-5">
    <h2 class="mb-4">Edit Profil Pelanggan</h2>
    <div class="card">
        <div class="card-body">
            <form method="post">
                <div class="form-group mb-2">
                    <label>Email</label>
                    <input disabled type="email" name="email" value="<?= htmlspecialchars($data_pelanggan['email']) ?>" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label>Password (kosongkan jika tidak ingin ubah)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="nama" value="<?= htmlspecialchars($data_pelanggan['nama_pelanggan']) ?>" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label>Telepon</label>
                    <input type="number" name="nopon" value="<?= htmlspecialchars($data_pelanggan['telp_pelanggan']) ?>" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required><?= htmlspecialchars($data_pelanggan['alamat']) ?></textarea>
                </div>
                <div class="form-group mb-2">
                    <label>Kota</label>
                    <input type="text" name="kota" value="<?= htmlspecialchars($data_pelanggan['kota']) ?>" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label>Kode Pos</label>
                    <input type="text" name="kodepos" value="<?= htmlspecialchars($data_pelanggan['kode_pos']) ?>" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label>Provinsi</label>
                    <input type="text" name="provinsi" value="<?= htmlspecialchars($data_pelanggan['provinsi']) ?>" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success mt-2">Simpan Perubahan</button>
                <a href="<?= base_url('profil') ?>" class="btn btn-secondary mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>