<!-- STYLE TAMBAHAN -->
<style>
    :root {
        --primary-color: #2563eb;
        --primary-hover: #1d4ed8;
        --secondary-color: #f59e0b;
        --dark-color: #1e293b;
        --light-color: #f8fafc;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --border-radius: 12px;
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    .product-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .image-main {
        width: 100%;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        aspect-ratio: 1/1;
        object-fit: cover;
        cursor: zoom-in;
        transition: var(--transition);
    }

    .image-main:hover {
        transform: scale(1.02);
    }

    .thumbnail-container {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .thumbnail {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        transition: var(--transition);
    }

    .thumbnail:hover,
    .thumbnail.active {
        border-color: var(--primary-color);
        transform: translateY(-3px);
    }

    .product-detail-card {
        background: #fff;
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--box-shadow);
        height: 100%;
    }

    .product-title {
        font-weight: 700;
        font-size: 1.8rem;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .product-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 1rem;
    }

    .product-rating {
        display: flex;
        align-items: center;
        color: var(--secondary-color);
        font-weight: 600;
    }

    .product-sku {
        color: #64748b;
        font-size: 0.9rem;
    }

    .price-container {
        margin: 1.5rem 0;
    }

    .original-price {
        font-size: 1.2rem;
        color: #64748b;
        text-decoration: line-through;
    }

    .discounted-price {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--danger-color);
    }

    .discount-badge {
        background-color: var(--danger-color);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: 10px;
    }

    .stock-status {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .in-stock {
        background-color: #dcfce7;
        color: var(--success-color);
    }

    .low-stock {
        background-color: #fef3c7;
        color: #d97706;
    }

    .out-of-stock {
        background-color: #fee2e2;
        color: var(--danger-color);
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .quantity-btn:hover {
        background: #e2e8f0;
    }

    .quantity-input {
        width: 60px;
        height: 40px;
        text-align: center;
        border-top: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        border-left: none;
        border-right: none;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 2rem;
    }

    .btn-primary2 {
        background-color: var(--primary-color);
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        flex: 1;
        transition: var(--transition);
        color: white;
    }

    .btn-primary2:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        background-color: white;
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        flex: 1;
        transition: var(--transition);
    }

    .btn-secondary:hover {
        background-color: #f1f5f9;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .product-tabs {
        margin-top: 3rem;
    }

    .nav-tabs {
        border-bottom: 1px solid #e2e8f0;
    }

    .nav-link {
        color: var(--dark-color);
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border: none;
        position: relative;
    }

    .nav-link.active {
        color: var(--primary-color);
        background: transparent;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--primary-color);
    }

    .tab-content {
        padding: 1.5rem 0;
    }

    .product-highlights {
        list-style-type: none;
        padding: 0;
    }

    .product-highlights li {
        padding: 0.5rem 0;
        display: flex;
        align-items: flex-start;
    }

    .product-highlights li::before {
        content: '✓';
        color: var(--success-color);
        font-weight: bold;
        margin-right: 10px;
    }

    .promo-banner {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border-radius: var(--border-radius);
        padding: 1rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
    }

    .promo-icon {
        font-size: 1.5rem;
        color: #d97706;
        margin-right: 1rem;
    }

    .promo-text {
        color: #92400e;
        font-weight: 500;
    }

    .delivery-info {
        background: #f8fafc;
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-top: 1.5rem;
    }

    .delivery-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .delivery-icon {
        color: var(--primary-color);
        margin-right: 1rem;
        font-size: 1.2rem;
    }

    .breadcrumb {
        background: none;
        padding: 0;
        margin-bottom: 1rem;
    }

    .breadcrumb-item a {
        color: #64748b;
        text-decoration: none;
        transition: var(--transition);
    }

    .breadcrumb-item a:hover {
        color: var(--primary-color);
    }

    .breadcrumb-item.active {
        color: var(--dark-color);
    }

    .zoom-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1050;
        cursor: zoom-out;
    }

    .zoomed-image {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }

    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }

        .product-title {
            font-size: 1.5rem;
        }

        .discounted-price {
            font-size: 1.5rem;
        }
    }
</style>

<!-- FLASH MESSAGE -->
<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('message'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- PRODUCT DETAIL -->
<div class="product-container mt-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('produk/kategori/' . $produk['categori_id']) ?>"><?= $produk['kt_nama'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $produk['pd_nama'] ?></li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Product Images -->
        <div class="col-lg-6">
            <div class="position-relative">
                <img id="mainImage" src="<?= base_url('uploads/produk/') . ($list_gambar[0]['nama_gambar'] ?? 'image-placeholder.jpg') ?>"
                    alt="<?= $produk['pd_nama'] ?>" class="image-main img-fluid"
                    onerror="this.src='<?= base_url('uploads/produk/image-placeholder.jpg') ?>'">

                <?php if (!empty($produk['persentase']) && $produk['persentase'] > 0): ?>
                    <div class="position-absolute top-0 start-0 bg-danger text-white px-3 py-1 rounded-end" style="font-weight: 600;">
                        <?= $produk['persentase'] ?>% OFF
                    </div>
                <?php endif; ?>
            </div>

            <div class="thumbnail-container">
                <?php foreach ($list_gambar as $index => $gambar): ?>
                    <img src="<?= base_url('uploads/produk/') . $gambar['nama_gambar'] ?>"
                        alt="Thumbnail <?= $index + 1 ?>" class="thumbnail <?= $index === 0 ? 'active' : '' ?>"
                        onclick="changeImage(this, '<?= base_url('uploads/produk/') . $gambar['nama_gambar'] ?>')">
                <?php endforeach ?>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <div class="product-detail-card">
                <h1 class="product-title"><?= $produk['pd_nama'] ?></h1>

                <div class="product-meta">
                    <div class="product-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="ms-1">4.5 (128 reviews)</span>
                    </div>
                    <div class="product-sku">
                        ID: <?= $produk['id_produk'] ?>
                    </div>
                </div>

                <?php if (!empty($produk['nama_diskon'])): ?>
                    <div class="promo-banner">
                        <div class="promo-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="promo-text">
                            Promo <strong><?= $produk['nama_diskon'] ?></strong> berlaku hingga <?= indo_date($produk['tanggal_akhir']); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="price-container">
                    <?php if (!empty($produk['harga_akhir']) && $produk['harga_akhir'] < $produk['harga']): ?>
                        <div class="d-flex align-items-center">
                            <div class="original-price">
                                Rp <?= number_format($produk['harga']) ?>
                            </div>
                            <div class="discounted-price ms-2">
                                Rp <?= number_format($produk['harga_akhir']) ?>
                            </div>
                            <div class="discount-badge">
                                Hemat <?= number_format($produk['harga'] - $produk['harga_akhir']) ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="discounted-price">
                            Rp <?= number_format($produk['harga']) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($produk['stok'] > 10): ?>
                    <div class="stock-status in-stock">
                        <i class="fas fa-check-circle me-1"></i> In Stock (<?= $produk['stok'] ?> available)
                    </div>
                <?php elseif ($produk['stok'] > 0): ?>
                    <div class="stock-status low-stock">
                        <i class="fas fa-exclamation-triangle me-1"></i> Low Stock (Only <?= $produk['stok'] ?> left)
                    </div>
                <?php else: ?>
                    <div class="stock-status out-of-stock">
                        <i class="fas fa-times-circle me-1"></i> Out of Stock
                    </div>
                <?php endif; ?>

                <div class="quantity-selector">
                    <label class="me-3" style="font-weight: 600;">Quantity:</label>
                    <button type="button" class="quantity-btn minus">-</button>
                    <input type="number" class="quantity-input" value="1" min="1" max="<?= $produk['stok'] ?>">
                    <button type="button" class="quantity-btn plus">+</button>
                </div>

                <div class="action-buttons">
                    <form action="<?= base_url("keranjang/tambah") ?>" method="post" class="w-100">
                        <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                        <input type="hidden" name="jumlah" class="quantity-submit" value="1">
                        <button type="submit" class="btn btn-primary2">
                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                        </button>
                    </form>
                    <button class="btn btn-secondary">
                        <i class="fas fa-heart me-2"></i> Wishlist
                    </button>
                </div>

                <div class="delivery-info">
                    <div class="delivery-item">
                        <div class="delivery-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div>
                            <h6 class="mb-1" style="font-weight: 600;">Free Shipping</h6>
                            <p class="mb-0 text-muted">Free delivery for orders above Rp 200,000</p>
                        </div>
                    </div>
                    <div class="delivery-item">
                        <div class="delivery-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <div>
                            <h6 class="mb-1" style="font-weight: 600;">Easy Returns</h6>
                            <p class="mb-0 text-muted">30 days return policy</p>
                        </div>
                    </div>
                    <div class="delivery-item mb-0">
                        <div class="delivery-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h6 class="mb-1" style="font-weight: 600;">Secure Payment</h6>
                            <p class="mb-0 text-muted">100% secure payment methods</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Tabs -->
    <div class="product-tabs">
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab" aria-controls="specs" aria-selected="false">Specifications</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
            </li>
        </ul>
        <div class="tab-content" id="productTabsContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <h5 style="font-weight: 600;">About This Product</h5>
                <p><?= nl2br($produk['deskripsi']) ?></p>

                <h5 class="mt-4" style="font-weight: 600;">Key Features</h5>
                <ul class="product-highlights">
                    <li>Premium quality ingredients for optimal nutrition</li>
                    <li>Specially formulated for kittens aged 2-12 months</li>
                    <li>Supports healthy growth and development</li>
                    <li>Highly palatable for picky eaters</li>
                    <li>Veterinarian recommended</li>
                </ul>
            </div>
            <div class="tab-pane fade" id="specs" role="tabpanel" aria-labelledby="specs-tab">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width: 40%;">Brand</th>
                                    <td>Royal Canin</td>
                                </tr>
                                <tr>
                                    <th>Product Type</th>
                                    <td>Dry Food</td>
                                </tr>
                                <tr>
                                    <th>Life Stage</th>
                                    <td>Kitten</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width: 40%;">Weight</th>
                                    <td>2kg</td>
                                </tr>
                                <tr>
                                    <th>Flavor</th>
                                    <td>Chicken</td>
                                </tr>
                                <tr>
                                    <th>Shelf Life</th>
                                    <td>18 months</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                <div class="d-flex align-items-center mb-4">
                    <div class="me-3">
                        <h2 class="mb-0">4.5</h2>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <div>
                        <p class="mb-0">Based on 128 customer reviews</p>
                    </div>
                </div>

                <div class="review-item mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <h6 style="font-weight: 600;">John D.</h6>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="text-muted">
                            <small>2 days ago</small>
                        </div>
                    </div>
                    <p>My kitten loves this food! She's been more active and her coat looks shinier since we switched to Royal Canin.</p>
                </div>

                <div class="review-item mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <h6 style="font-weight: 600;">Sarah M.</h6>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="text-muted">
                            <small>1 week ago</small>
                        </div>
                    </div>
                    <p>Great quality food at a reasonable price, especially with the current promotion. Will definitely buy again!</p>
                </div>

                <button class="btn btn-outline-primary">See All Reviews</button>
            </div>
        </div>
    </div>

    <!-- Related Products Section -->
    <div class="mt-5">
        <h4 class="mb-4" style="font-weight: 600;">Rekomendasi Produk</h4>
        <div class="row">
            <!-- Related product cards would go here -->
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Related Product">
                    <div class="card-body">
                        <h5 class="card-title">Royal Canin Adult</h5>
                        <p class="card-text text-danger fw-bold">Rp 150,000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Related Product">
                    <div class="card-body">
                        <h5 class="card-title">Whiskas Kitten</h5>
                        <p class="card-text text-danger fw-bold">Rp 95,000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Related Product">
                    <div class="card-body">
                        <h5 class="card-title">Pro Plan Kitten</h5>
                        <p class="card-text text-danger fw-bold">Rp 135,000</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Related Product">
                    <div class="card-body">
                        <h5 class="card-title">Friskies Kitten</h5>
                        <p class="card-text text-danger fw-bold">Rp 85,000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Zoom Modal -->
<div id="imageZoomModal" class="zoom-overlay d-none">
    <img id="zoomedImage" src="" alt="Zoomed Product Image" class="zoomed-image">
</div>

<script>
    // Change main image when thumbnail is clicked
    function changeImage(element, newSrc) {
        document.getElementById('mainImage').src = newSrc;

        // Update active thumbnail
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        element.classList.add('active');
    }

    // Quantity selector functionality
    document.querySelector('.quantity-btn.minus').addEventListener('click', function() {
        const input = document.querySelector('.quantity-input');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            document.querySelector('.quantity-submit').value = input.value;
        }
    });

    document.querySelector('.quantity-btn.plus').addEventListener('click', function() {
        const input = document.querySelector('.quantity-input');
        const max = parseInt(input.getAttribute('max'));
        if (parseInt(input.value) < max) {
            input.value = parseInt(input.value) + 1;
            document.querySelector('.quantity-submit').value = input.value;
        }
    });

    document.querySelector('.quantity-input').addEventListener('change', function() {
        const max = parseInt(this.getAttribute('max'));
        const min = parseInt(this.getAttribute('min'));
        let value = parseInt(this.value);

        if (isNaN(value)) value = min;
        if (value < min) value = min;
        if (value > max) value = max;

        this.value = value;
        document.querySelector('.quantity-submit').value = value;
    });

    // Image zoom functionality
    document.getElementById('mainImage').addEventListener('click', function() {
        const modal = document.getElementById('imageZoomModal');
        const zoomedImg = document.getElementById('zoomedImage');

        zoomedImg.src = this.src;
        modal.classList.remove('d-none');
    });

    document.getElementById('imageZoomModal').addEventListener('click', function() {
        this.classList.add('d-none');
    });
</script>