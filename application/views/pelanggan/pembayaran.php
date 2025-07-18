<div class="container mt-4 mb-5 payment-container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Order Summary Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted">Order ID</h6>
                                <p class="fw-bold"><?= $pesanan['id_pesanan']; ?></p>
                            </div>
                            <div class="mb-3">
                                <h6 class="text-muted">Order Date</h6>
                                <p class="fw-bold"><?= date('d M Y, H:i', strtotime($pesanan['tanggal_pesanan'])); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted">Total Amount</h6>
                                <p class="fw-bold text-primary fs-4">Rp <?= number_format($pesanan['total_pesanan'], 0, ',', '.'); ?></p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3"><i class="fas fa-box-open me-2"></i>Order Items</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 80px">Image</th>
                                    <th>Product</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($produk as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="product-img-container">
                                                <?php if ($item['gambar']): ?>
                                                    <img src="<?= $item['gambar']; ?>" alt="<?= $item['nama_produk']; ?>" class="img-thumbnail">
                                                <?php else: ?>
                                                    <div class="no-image-placeholder">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td><?= $item['nama_produk']; ?></td>
                                        <td class="text-end">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
                                        <td class="text-center"><?= $item['jumlah']; ?></td>
                                        <td class="text-end fw-bold">Rp <?= number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Payment Status Card -->
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-<?= ($pembayaran && $pembayaran['bukti_pembayaran'] !== null) ? 'success' : 'warning'; ?> text-white">
                    <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Payment Status</h5>
                </div>
                <div class="card-body">
                    <?php if ($pembayaran && $pembayaran['bukti_pembayaran'] !== null): ?>
                        <div class="payment-status">
                            <div class="status-badge <?= $pembayaran['status']; ?> mb-3">
                                <span><?= ucfirst($pembayaran['status']); ?></span>
                            </div>

                            <div class="payment-details">
                                <div class="detail-item">
                                    <span class="detail-label">Payment Date:</span>
                                    <span class="detail-value"><?= date('d M Y, H:i', strtotime($pembayaran['tanggal_pembayaran'])); ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Amount Paid:</span>
                                    <span class="detail-value fw-bold">Rp <?= number_format($pembayaran['total_bayar'], 0, ',', '.'); ?></span>
                                </div>
                            </div>

                            <hr>

                            <h6 class="mb-3">Payment Proof</h6>
                            <div class="payment-proof">
                                <img src="<?= base_url('uploads/bukti-pembayaran/') . $pembayaran['bukti_pembayaran'] ?>" alt="Payment Proof" class="img-fluid rounded border">
                                <div class="mt-2 text-center">
                                    <a href="<?= base_url('uploads/bukti-pembayaran/') . $pembayaran['bukti_pembayaran'] ?>" class="btn btn-sm btn-outline-primary" download>
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary w-100" onclick="window.print()">
                                    <i class="fas fa-print me-1"></i> Print Receipt
                                </button>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="payment-form">
                            <h6 class="mb-3">Complete Your Payment</h6>
                            <p class="text-muted small mb-4">Please upload your payment proof to complete the transaction.</p>
                            <form action="<?= base_url('pembayaran/bayar') ?>" method="post" enctype="multipart/form-data" id="paymentForm">
                                <input type="hidden" name="id_pesanan" value="<?= $pesanan['id_pesanan']; ?>">
                                <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran']; ?>">
                                <input type="hidden" name="order_id" value="<?= $pembayaran['order_id']; ?>">

                                <div class="mb-4">
                                    <label for="bukti_pembayaran" class="form-label">Upload Payment Proof</label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" required accept="image/*">
                                        <div class="file-upload-info mt-2 small text-muted">Accepted formats: JPG, PNG (Max 2MB)</div>
                                    </div>
                                    <div id="previewContainer" class="mt-3 d-none">
                                        <img id="paymentProofPreview" src="#" alt="Preview" class="img-fluid rounded border d-none">
                                        <button type="button" id="removePreview" class="btn btn-sm btn-outline-danger mt-2">
                                            <i class="fas fa-times me-1"></i> Remove
                                        </button>
                                    </div>
                                </div>

                                <div class="payment-instructions mb-4">
                                    <h6 class="mb-2">Payment Instructions</h6>
                                    <div class="accordion" id="bankAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bankDetails">
                                                    <i class="fas fa-university me-2"></i> Bank Transfer
                                                </button>
                                            </h2>
                                            <div id="bankDetails" class="accordion-collapse collapse" data-bs-parent="#bankAccordion">
                                                <div class="accordion-body small">
                                                    <div class="bank-account mb-2">
                                                        <span class="fw-bold">BCA</span>
                                                        <div>Account Number: 1234567890</div>
                                                        <div>Account Name: Your Store Name</div>
                                                    </div>
                                                    <div class="bank-account">
                                                        <span class="fw-bold">Mandiri</span>
                                                        <div>Account Number: 0987654321</div>
                                                        <div>Account Name: Your Store Name</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2" id="uploadPaymentBtn">
                                    <i class="fas fa-paper-plane me-1"></i> Submit Payment
                                </button>
                                <button type="button" class="btn btn-secondary w-100 py-2 mt-2" id="qrisPaymentBtn">
                                    <i class="fas fa-qrcode me-1"></i> Pay with QRIS
                                </button>
                                <button type="button" class="btn btn-outline-secondary w-100 py-2 mt-2" id="checkStatus">
                                    <i class="fas fa-sync-alt me-1"></i>
                                    Check Status Qris
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .payment-container {
        max-width: 1200px;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
        border: none;
    }

    .card-header {
        padding: 1rem 1.5rem;
    }

    .product-img-container {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-img-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .no-image-placeholder {
        width: 100%;
        height: 100%;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccc;
    }

    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }

    .status-badge.pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .status-badge.terverifikasi {
        background-color: #d4edda;
        color: #155724;
    }

    .status-badge.failed {
        background-color: #f8d7da;
        color: #721c24;
    }

    .payment-details .detail-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .payment-details .detail-label {
        color: #6c757d;
    }

    .payment-details .detail-value {
        font-weight: 500;
    }

    .file-upload-wrapper {
        border: 2px dashed #dee2e6;
        padding: 1.5rem;
        text-align: center;
        border-radius: 8px;
        background: #f8f9fa;
        transition: all 0.3s;
    }

    .file-upload-wrapper:hover {
        border-color: #0d6efd;
        background: #f0f7ff;
    }

    .pdf-preview-icon {
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 5px;
        text-align: center;
    }

    .pdf-preview-icon i {
        font-size: 2rem;
        color: #d63384;
        display: block;
        margin-bottom: 0.5rem;
    }

    .bank-account {
        padding: 0.5rem;
        background: #f8f9fa;
        border-radius: 5px;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 991.98px) {
        .sticky-top {
            position: static !important;
        }
    }
</style>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key='SB-Mid-client-yL1KsvjYvoXRmMGa'></script>


<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('bukti_pembayaran');
        const previewContainer = document.getElementById('previewContainer');
        const imgPreview = document.getElementById('paymentProofPreview');
        const removeBtn = document.getElementById('removePreview');

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file && file.type.match('image.*')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.src = e.target.result;
                        imgPreview.classList.remove('d-none');
                        previewContainer.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                }
            });

            removeBtn.addEventListener('click', function() {
                fileInput.value = '';
                previewContainer.classList.add('d-none');
                imgPreview.classList.add('d-none');
            });
        }

        const paymentForm = document.getElementById('paymentForm');

        document.getElementById('qrisPaymentBtn').addEventListener('click', function(e) {
            e.preventDefault();
            window.snap.pay('<?= $pembayaran['snap_token']; ?>', {
                onSuccess: function(result) {
                    // Handle success response
                    console.log('Payment Success:', result);
                    paymentForm.action = '<?= base_url('pembayaran/update_status'); ?>';
                    paymentForm.submit();
                },
                onPending: function(result) {
                    // Handle pending response
                    console.log('Payment Pending:', result);
                    paymentForm.action = '<?= base_url('pembayaran/update_status'); ?>';
                    paymentForm.submit();
                },
                onError: function(result) {
                    // Handle error response
                    console.error('Payment Error:', result);
                    paymentForm.action = '<?= base_url('pembayaran/update_status'); ?>';
                    paymentForm.submit();
                }
            });
        });

        document.getElementById('checkStatus').addEventListener('click', function() {

            paymentForm.action = '<?= base_url('pembayaran/update_status'); ?>';
            paymentForm.submit();
        });
    });
</script>