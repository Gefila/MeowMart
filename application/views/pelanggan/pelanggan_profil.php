<?php
$foto = !empty($data_pelanggan['foto_pelanggan'])
    ? base_url('uploads/profil-pelanggan/') . $data_pelanggan['foto_pelanggan']
    : 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png';
?>

<div class="container">
    <div class="row">
        <!-- Left Side - Profile Card -->
        <div class="col-lg-4">
            <div class="card profile-card shadow-lg rounded-4">
                <div class="card-body text-center p-4">
                    <!-- Profile Picture with Upload Indicator -->
                    <div class="avatar-upload">
                        <div class="avatar-preview">
                            <img src="<?= $foto ?>"
                                alt="Profile Photo"
                                class="rounded-circle shadow"
                                id="profile-preview">
                            <div class="upload-indicator">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-3 mb-1"><?= htmlspecialchars($data_pelanggan['nama_pelanggan']) ?></h3>
                    <p class="text-muted mb-3">Customer ID: #<?= htmlspecialchars($data_pelanggan['id_pelanggan']) ?></p>

                    <!-- Contact Info -->
                    <div class="contact-info">
                        <div class="d-flex align-items-center mb-2">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div class="ms-3">
                                <p class="mb-0"><?= htmlspecialchars($data_pelanggan['email']) ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div class="ms-3">
                                <p class="mb-0"><?= htmlspecialchars($data_pelanggan['telp_pelanggan']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <a href="<?= base_url('profil/ubah') ?>" class="btn btn-primary mt-4 w-100 rounded-pill">
                        <i class="fas fa-user-edit me-2"></i>Edit Profile
                    </a>

                    <!-- Stats (if applicable) -->
                    <div class="stats-container mt-4">
                        <div class="stat-item">
                            <h5>12</h5>
                            <p>Orders</p>
                        </div>
                        <div class="stat-item">
                            <h5>4.8</h5>
                            <p>Rating</p>
                        </div>
                        <div class="stat-item">
                            <h5>2</h5>
                            <p>Years</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Details -->
        <div class="col-lg-8">
            <div class="card details-card shadow-lg rounded-4">
                <div class="card-body p-4">
                    <!-- Flash Message -->
                    <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert alert-dismissible fade show <?= strpos($this->session->flashdata('message'), 'success') ? 'alert-success' : 'alert-danger' ?>">
                            <?= $this->session->flashdata('message') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Navigation Tabs -->
                    <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">
                                <i class="fas fa-user-circle me-2"></i>Personal Info
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab">
                                <i class="fas fa-map-marker-alt me-2"></i>Address
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab">
                                <i class="fas fa-history me-2"></i>Activity
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="profileTabsContent">
                        <!-- Personal Info Tab -->
                        <div class="tab-pane fade show active" id="personal" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item mb-4">
                                        <h6 class="info-label"><i class="fas fa-id-card me-2"></i>Full Name</h6>
                                        <p class="info-value"><?= htmlspecialchars($data_pelanggan['nama_pelanggan']) ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-4">
                                        <h6 class="info-label"><i class="fas fa-envelope me-2"></i>Email</h6>
                                        <p class="info-value"><?= htmlspecialchars($data_pelanggan['email']) ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-4">
                                        <h6 class="info-label"><i class="fas fa-phone me-2"></i>Phone</h6>
                                        <p class="info-value"><?= htmlspecialchars($data_pelanggan['telp_pelanggan']) ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item mb-4">
                                        <h6 class="info-label"><i class="fas fa-calendar-alt me-2"></i>Member Since</h6>
                                        <p class="info-value"><?= date('F j, Y', strtotime($data_pelanggan['created_at'] ?? 'now')) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Tab -->
                        <div class="tab-pane fade" id="address" role="tabpanel">
                            <div class="address-card">
                                <div class="address-header">
                                    <h5><i class="fas fa-home me-2"></i>Primary Address</h5>
                                </div>
                                <div class="address-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="info-item mb-3">
                                                <h6 class="info-label">Street Address</h6>
                                                <p class="info-value"><?= htmlspecialchars($data_pelanggan['alamat']) ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item mb-3">
                                                <h6 class="info-label">City</h6>
                                                <p class="info-value"><?= htmlspecialchars($data_pelanggan['kota']) ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item mb-3">
                                                <h6 class="info-label">Province</h6>
                                                <p class="info-value"><?= htmlspecialchars($data_pelanggan['provinsi']) ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item mb-3">
                                                <h6 class="info-label">Postal Code</h6>
                                                <p class="info-value"><?= htmlspecialchars($data_pelanggan['kode_pos']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button class="btn btn-outline-primary rounded-pill">
                                            <i class="fas fa-map-marked-alt me-2"></i>View on Map
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Activity Tab -->
                        <div class="tab-pane fade" id="activity" role="tabpanel">
                            <h5 class="mb-4">Recent Activity</h5>
                            <div class="activity-timeline">
                                <div class="activity-item">
                                    <div class="activity-badge">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <div class="activity-content">
                                        <h6>New Order Placed</h6>
                                        <p class="text-muted">Order #12345 - June 15, 2023</p>
                                        <p>2 items - $125.00</p>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-badge">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                    <div class="activity-content">
                                        <h6>Profile Updated</h6>
                                        <p class="text-muted">June 10, 2023</p>
                                        <p>Changed phone number</p>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-badge">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="activity-content">
                                        <h6>Left a Review</h6>
                                        <p class="text-muted">June 5, 2023</p>
                                        <p>Rated 5 stars for Product X</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-card {
        border: none;
        position: relative;
        overflow: hidden;
        border-radius: 15px !important;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .profile-card:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 120px;
        background: linear-gradient(to right, #4e73df, #224abe);
        z-index: 1;
    }

    .profile-card .card-body {
        position: relative;
        z-index: 2;
    }

    .avatar-upload {
        position: relative;
        margin: 0 auto 1rem;
        width: 130px;
    }

    .avatar-preview {
        width: 130px;
        height: 130px;
        position: relative;
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .upload-indicator {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 30px;
        height: 30px;
        background: #4e73df;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: all 0.3s;
    }

    .upload-indicator:hover {
        transform: scale(1.1);
    }

    .icon-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stats-container {
        display: flex;
        justify-content: space-around;
        padding: 1rem 0;
        border-top: 1px solid #eee;
        margin-top: 1rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-item h5 {
        font-weight: 700;
        margin-bottom: 0.2rem;
        color: #4e73df;
    }

    .stat-item p {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0;
    }

    .details-card {
        border: none;
        border-radius: 15px !important;
        background: #ffffff;
    }

    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 0;
    }

    .nav-tabs .nav-link.active {
        color: #4e73df;
        background: transparent;
        border-bottom: 3px solid #4e73df;
    }

    .info-item {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 10px;
        height: 100%;
    }

    .info-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .info-value {
        font-size: 1rem;
        color: #343a40;
        font-weight: 500;
        margin-bottom: 0;
    }

    .address-card {
        border: 1px solid #eee;
        border-radius: 10px;
        overflow: hidden;
    }

    .address-header {
        background: #f8f9fa;
        padding: 0.75rem 1.25rem;
        border-bottom: 1px solid #eee;
    }

    .address-header h5 {
        margin-bottom: 0;
        font-weight: 600;
    }

    .address-body {
        padding: 1.25rem;
    }

    .activity-timeline {
        position: relative;
        padding-left: 30px;
    }

    .activity-timeline:before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #dee2e6;
    }

    .activity-item {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .activity-badge {
        position: absolute;
        left: -30px;
        top: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #4e73df;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
    }

    .activity-content {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        margin-left: 1rem;
    }

    .activity-content h6 {
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .activity-content p {
        margin-bottom: 0.2rem;
        font-size: 0.9rem;
    }

    @media (max-width: 992px) {
        .profile-card {
            margin-bottom: 2rem;
        }
    }
</style>

<script>
    // Simple script to handle profile image upload preview
    document.addEventListener('DOMContentLoaded', function() {
        const uploadIndicator = document.querySelector('.upload-indicator');
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*';
        fileInput.style.display = 'none';

        uploadIndicator.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profile-preview').src = event.target.result;
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
</script>