<style>
    :root {
        --primary: #4361ee;
        --primary-light: #e6e9ff;
        --secondary: #6c757d;
        --danger: #dc3545;
        --success: #28a745;
        --light: #f8f9fa;
        --dark: #212529;
        --border-radius: 12px;
        --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .cart-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
        display: flex;
        gap: 2rem;
    }

    .cart-main {
        flex: 1;
    }

    .cart-sidebar {
        width: 350px;
        position: sticky;
        top: 4.3rem;
        height: fit-content;
    }

    .cart-header {
        display: flex;
        max-width: 1200px;
        padding: 0 1rem;
        flex-direction: column;
        margin: 2rem auto;
        margin-bottom: 2rem;
    }

    .cart-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark);
    }

    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .cart-item {
        background: white;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--box-shadow);
        display: flex;
        gap: 1.5rem;
        position: relative;
    }

    .cart-item-image {
        width: 120px;
        height: 120px;
        border-radius: var(--border-radius);
        object-fit: cover;
        flex-shrink: 0;
    }

    .cart-item-details {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .cart-item-name {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }

    .cart-item-category {
        font-size: 0.9rem;
        color: var(--secondary);
        margin-bottom: 0.5rem;
    }

    .cart-item-desc {
        font-size: 0.9rem;
        color: var(--secondary);
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .cart-item-price {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .current-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary);
    }

    .original-price {
        font-size: 0.9rem;
        text-decoration: line-through;
        color: var(--secondary);
    }

    .discount-badge {
        background-color: var(--primary-light);
        color: var(--primary);
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-weight: 600;
        margin-left: 0.5rem;
    }

    .cart-item-actions {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-end;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .quantity-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--light);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .quantity-btn:hover {
        background: #e0e0e0;
    }

    .quantity-value {
        width: 36px;
        text-align: center;
        font-weight: 600;
    }

    .remove-btn {
        background: none;
        border: none;
        color: var(--danger);
        cursor: pointer;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        transition: all 0.2s;
    }

    .remove-btn:hover {
        color: #b02a37;
    }

    .cart-summary {
        background: white;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--box-shadow);
    }

    .summary-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--dark);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .summary-total {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        border-top: 1px solid #eee;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .checkout-btn {
        width: 100%;
        background: var(--primary);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-weight: 600;
        margin-top: 1.5rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .checkout-btn:hover {
        background: #3a56d4;
    }

    .empty-cart {
        text-align: center;
        padding: 4rem 0;
    }

    .empty-cart-icon {
        font-size: 4rem;
        color: var(--secondary);
        margin-bottom: 1rem;
    }

    .empty-cart-text {
        font-size: 1.2rem;
        color: var(--secondary);
        margin-bottom: 1.5rem;
    }

    .continue-shopping {
        background: var(--primary);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .continue-shopping:hover {
        background: #3a56d4;
    }

    @media (max-width: 992px) {
        .cart-container {
            flex-direction: column;
        }

        .cart-sidebar {
            width: 100%;
            position: static;
        }
    }

    @media (max-width: 768px) {
        .cart-item {
            flex-direction: column;
        }

        .cart-item-image {
            width: 100%;
            height: auto;
            max-height: 200px;
        }

        .cart-item-actions {
            flex-direction: row;
            align-items: center;
            margin-top: 1rem;
        }
    }
</style>

<div class="cart-header">
    <div class="header-content" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
        <div>
            <h1 class="cart-title">Keranjang Belanja</h1>
            <span><?= count($produk) ?> item</span>
        </div>
        <?php if (!empty($produk)): ?>
            <!-- <div class="quick-actions" style="display: flex; gap: 0.5rem; margin-top: 1rem;">
                <button onclick="selectAllItems()" class="quick-action-btn" style="padding: 0.5rem 1rem; background: var(--light); border: 1px solid #ddd; border-radius: 6px; cursor: pointer; font-size: 0.9rem; transition: all 0.2s;">
                    <i class="fas fa-check-square"></i> Pilih Semua
                </button>
                <button onclick="clearCart()" class="quick-action-btn" style="padding: 0.5rem 1rem; background: var(--danger); color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 0.9rem; transition: all 0.2s;">
                    <i class="fas fa-trash"></i> Kosongkan Keranjang
                </button>
            </div> -->
        <?php endif; ?>
    </div>
</div>
<div class="cart-container">
    <div class="cart-main">
        <?php if ($this->session->flashdata('message')): ?>
            <?= $this->session->flashdata('message'); ?>
        <?php endif; ?>

        <?php if (empty($produk)): ?>
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <p class="empty-cart-text">Keranjang belanja Anda kosong</p>
                <a href="<?= base_url('produk') ?>" class="continue-shopping">
                    Lanjutkan Belanja
                </a>
            </div>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($produk as $item): ?>
                    <?php $sub_total = $item['jumlah'] * $item['harga_akhir']; ?>
                    <div class="cart-item">
                        <img src="<?= base_url('uploads/produk/' . (!empty($item['gambar'][0]['nama_gambar']) ? $item['gambar'][0]['nama_gambar'] : 'image-placeholder.jpg')) ?>"
                            alt="<?= $item['pd_nama']; ?>"
                            class="cart-item-image">

                        <div class="cart-item-details">
                            <div>
                                <h3 class="cart-item-name"><?= $item['pd_nama']; ?></h3>
                                <span class="cart-item-category"><?= $item['kt_nama']; ?></span>
                                <p class="cart-item-desc"><?= $item['deskripsi']; ?></p>

                                <!-- Stock Information -->
                                <?php if (isset($item['stok']) && $item['stok'] <= 5): ?>
                                    <div class="stock-warning" style="color: var(--danger); font-size: 0.8rem; margin-top: 0.5rem;">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Stok terbatas! Hanya tersisa <?= $item['stok'] ?> item
                                    </div>
                                <?php elseif (isset($item['stok'])): ?>
                                    <div class="stock-info" style="color: var(--success); font-size: 0.8rem; margin-top: 0.5rem;">
                                        <i class="fas fa-check-circle"></i>
                                        Stok tersedia (<?= $item['stok'] ?> item)
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="cart-item-price">
                                <?php if (!empty($item['harga_akhir']) && $item['harga_akhir'] < $item['harga']): ?>
                                    <span class="current-price">
                                        Rp <?= number_format($item['harga_akhir'], 0, ',', '.'); ?>
                                        <span class="discount-badge">Diskon <?= $item['persentase'] ?>%</span>
                                    </span>
                                    <span class="original-price">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></span>
                                <?php else: ?>
                                    <span class="current-price">Rp <?= number_format($item['harga'], 0, ',', '.'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="cart-item-actions">
                            <div class="quantity-control">
                                <form action="<?= base_url('keranjang/ubah/') ?>" method="post" class="d-inline">
                                    <input type="hidden" name="id_keranjang_produk" value="<?= $item['id_keranjang_produk']; ?>">
                                    <input type="hidden" name="id_produk" value="<?= $item['id_produk']; ?>">
                                    <input type="hidden" name="jumlah" value="<?= $item['jumlah'] - 1 ?>">
                                    <button type="submit" class="quantity-btn" <?= ($item['jumlah'] <= 1 ? 'disabled' : '') ?>>
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </form>
                                <span class="quantity-value"><?= $item['jumlah']; ?></span>
                                <form action="<?= base_url('keranjang/ubah/') ?>" method="post" class="d-inline">
                                    <input type="hidden" name="id_keranjang_produk" value="<?= $item['id_keranjang_produk']; ?>">
                                    <input type="hidden" name="id_produk" value="<?= $item['id_produk']; ?>">
                                    <input type="hidden" name="jumlah" value="<?= $item['jumlah'] + 1 ?>">
                                    <button type="submit" class="quantity-btn">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                            </div>

                            <form action="<?= base_url('keranjang/hapus/') ?>" method="post" onsubmit="return deleteItem(event)">
                                <input type="hidden" name="id_keranjang_produk" value="<?= $item['id_keranjang_produk']; ?>">
                                <button type="submit" class="remove-btn">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($produk)): ?>
        <div class="cart-sidebar">
            <div class="cart-summary">
                <h2 class="summary-title">Ringkasan Belanja</h2>

                <div class="summary-row">
                    <span>Subtotal (<?= count($produk) ?> item)</span>
                    <span>Rp <?= number_format($total, 0, ',', '.'); ?></span>
                </div>

                <div class="summary-row">
                    <span>Pengiriman</span>
                    <span>Gratis</span>
                </div>

                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>Rp <?= number_format($total, 0, ',', '.'); ?></span>
                </div>

                <form action="<?= base_url('pesanan/tambah') ?>" method="post" onsubmit="return confirm('Apakah anda yakin ingin checkout?')">
                    <input type="hidden" name="keranjang_id" value="<?= $keranjang_id; ?>">
                    <button type="submit" class="checkout-btn">
                        Checkout Sekarang
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    function deleteItem(event) {
        event.preventDefault(); // Mencegah form langsung terkirim

        Swal.fire({
            title: 'Hapus Produk',
            text: 'Apakah Anda yakin ingin menghapus produk ini dari keranjang?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); // Submit form jika dikonfirmasi
            }
        });

        return false; // Untuk jaga-jaga agar tidak lanjut submit
    }
</script>