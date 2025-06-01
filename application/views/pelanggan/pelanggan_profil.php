<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center mb-4"><i class="fa-solid fa-user-circle me-2"></i>Profil Pelanggan</h2>

            <?php if ($this->session->flashdata('sukses')): ?>
                <div class="alert alert-success text-center">
                    <i class="fa-solid fa-circle-check me-2"></i><?= $this->session->flashdata('sukses') ?>
                </div>
            <?php endif; ?>

            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-4">

                    <!-- Foto Profil -->
                    <div class="text-center mb-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png"
                            alt="Foto Profil"
                            class="rounded-circle shadow-sm border border-2"
                            width="130" height="130">
                        <h4 class="mt-3"><?= htmlspecialchars($data_pelanggan['nama_pelanggan']) ?></h4>
                        <p class="text-muted"><i class="fa-solid fa-envelope me-2"></i><?= htmlspecialchars($data_pelanggan['email']) ?></p>
                    </div>

                    <!-- Informasi Profil -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fa-solid fa-phone me-2"></i>Telepon:</label>
                            <div><?= htmlspecialchars($data_pelanggan['telp_pelanggan']) ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fa-solid fa-location-dot me-2"></i>Alamat:</label>
                            <div><?= htmlspecialchars($data_pelanggan['alamat']) ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fa-solid fa-city me-2"></i>Kota:</label>
                            <div><?= htmlspecialchars($data_pelanggan['kota']) ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fa-solid fa-envelope-open-text me-2"></i>Kode Pos:</label>
                            <div><?= htmlspecialchars($data_pelanggan['kode_pos']) ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="fa-solid fa-map me-2"></i>Provinsi:</label>
                            <div><?= htmlspecialchars($data_pelanggan['provinsi']) ?></div>
                        </div>
                    </div>

                    <!-- Tombol Edit -->
                    <div class="text-center mt-4">
                        <a href="<?= base_url('profil/ubah') ?>" class="btn btn-primary px-4 rounded-pill">
                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profil
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>