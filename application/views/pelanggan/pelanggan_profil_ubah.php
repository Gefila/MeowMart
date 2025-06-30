<?php
// Tentukan path foto profil dengan placeholder jika kosong
$foto = !empty($data_pelanggan['foto_pelanggan'])
    ? base_url('uploads/profil-pelanggan/') . $data_pelanggan['foto_pelanggan']
    : 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png';
?>

<style>
    /* Style untuk kontainer foto profil */
    .profile-picture-container {
        position: relative;
        cursor: pointer;
        display: inline-block;
        border-radius: 50%;
        overflow: hidden;
        /* Memastikan overlay tidak keluar dari lingkaran */
    }

    /* Foto profil utama */
    #img-profile {
        width: 200px;
        height: 200px;
        object-fit: cover;
        /* Mencegah gambar gepeng */
        transition: filter 0.3s ease;
    }

    /* Overlay yang muncul saat hover */
    .profile-picture-container .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 50%;
        flex-direction: column;
        font-size: 1.2rem;
    }

    .profile-picture-container:hover #img-profile {
        filter: brightness(0.7);
    }

    .profile-picture-container:hover .overlay {
        opacity: 1;
    }

    .overlay .bi-camera-fill {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    /* Sembunyikan input file asli */
    #file-input {
        display: none;
    }
</style>

<div class="container my-5">

    <?php if ($this->session->flashdata('message')) : ?>
        <?= $this->session->flashdata('message') ?>
    <?php endif ?>

    <h2 class="mb-4">Edit Profil</h2>

    <form method="post" enctype="multipart/form-data">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3">Foto Profil</h5>

                        <div class="profile-picture-container mx-auto mb-3" id="profile-picture-wrapper">
                            <img src="<?= $foto ?>" alt="Foto Profil" class="shadow-sm" id="img-profile">
                            <div class="overlay">
                                <i class="bi bi-camera-fill"></i>
                                <span>Ganti Foto</span>
                            </div>
                        </div>
                        <input type="file" name="foto_pelanggan" id="file-input" accept="image/*">

                        <p class="text-muted small">Klik pada gambar untuk mengganti foto. <br> Ukuran maks. 2MB.</p>

                        <?php if (!empty($data_pelanggan['foto_pelanggan'])) : ?>
                            <button type="button" class="btn btn-sm btn-outline-danger" id="remove-photo-btn">
                                <i class="bi bi-trash"></i> Hapus Foto
                            </button>
                            <input type="hidden" name="hapus_foto" id="hapus_foto_input" value="0">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Data Diri</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($data_pelanggan['email']) ?>" readonly disabled>
                            <label for="email">Email</label>
                            <div class="form-text">Email tidak dapat diubah.</div>
                        </div>

                        <label class="form-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password baru">
                            <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        <div class="form-text mt-0 mb-3">Kosongkan jika tidak ingin mengubah password.</div>

                        <div class="form-floating mb-3">
                            <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($data_pelanggan['nama_pelanggan']) ?>" placeholder="Nama Lengkap" required>
                            <label for="nama">Nama Lengkap</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="tel" name="nopon" class="form-control" id="nopon" value="<?= htmlspecialchars($data_pelanggan['telp_pelanggan']) ?>" placeholder="Nomor Telepon" required>
                            <label for="nopon">Nomor Telepon</label>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Alamat</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-floating mb-3">
                            <textarea name="alamat" class="form-control" placeholder="Alamat Lengkap" id="alamat" style="height: 100px" required><?= htmlspecialchars($data_pelanggan['alamat']) ?></textarea>
                            <label for="alamat">Alamat Lengkap</label>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="kota" class="form-control" id="kota" value="<?= htmlspecialchars($data_pelanggan['kota']) ?>" placeholder="Kota" required>
                                    <label for="kota">Kota</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="provinsi" class="form-control" id="provinsi" value="<?= htmlspecialchars($data_pelanggan['provinsi']) ?>" placeholder="Provinsi" required>
                                    <label for="provinsi">Provinsi</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="kodepos" class="form-control" id="kodepos" value="<?= htmlspecialchars($data_pelanggan['kode_pos']) ?>" placeholder="Kode Pos" required>
                                    <label for="kodepos">Kode Pos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= base_url('profil') ?>" class="btn btn-light me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilePictureWrapper = document.getElementById('profile-picture-wrapper');
        const fileInput = document.getElementById('file-input');
        const imgProfile = document.getElementById('img-profile');
        const removePhotoButton = document.getElementById('remove-photo-btn');
        const hapusFotoInput = document.getElementById('hapus_foto_input');
        const placeholderImage = 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png';

        // 1. Logika untuk mengganti foto
        if (profilePictureWrapper) {
            profilePictureWrapper.addEventListener('click', () => {
                fileInput.click();
            });
        }

        if (fileInput) {
            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgProfile.src = e.target.result;
                        // Jika ada tombol hapus, pastikan flag hapus disetel ke 0 saat gambar baru dipilih
                        if (hapusFotoInput) {
                            hapusFotoInput.value = '0';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // 2. Logika untuk menghapus foto
        if (removePhotoButton) {
            removePhotoButton.addEventListener('click', () => {
                // Konfirmasi sebelum menghapus
                if (confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
                    imgProfile.src = placeholderImage; // Kembalikan ke gambar placeholder
                    fileInput.value = ''; // Hapus file yang mungkin sudah dipilih
                    hapusFotoInput.value = '1'; // Set flag untuk dikirim ke server
                }
            });
        }

        // 3. Logika untuk toggle password
        const togglePassword = document.getElementById('toggle-password');
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const passwordInput = document.getElementById('password');
                const icon = this.querySelector('i');

                // Ubah tipe input
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                // Ubah ikon
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        }
    });
</script>