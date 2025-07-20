

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
                        <button type="submit" class="btn btn-primary2" <?= (intval($produk['stok']) <= 0) ? 'disabled' : '' ?>>
                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                        </button>
                    </form>
                    <button class="btn btn-secondary2">
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
                <button class="nav-link2 active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link2" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab" aria-controls="specs" aria-selected="false">Specifications</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link2" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
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
        <h4 class="mb-4" style="font-weight: 700; color: var(--primary-color); letter-spacing: 0.5px;">
            <i class="fas fa-thumbs-up me-2"></i>Rekomendasi Produk
        </h4>
        <div class="row g-4">
            <?php foreach ($rekomendasi_produk as $related): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <a class="card h-100 border-0 shadow-sm related-product-card text-decoration-none" 
                       href="<?= base_url('produk/' . $related['id_produk']) ?>" 
                       style="transition: box-shadow .2s, transform .2s;">
                        <div class="position-relative">
                            <img src="<?= base_url('uploads/produk/') . ($related['nama_gambar'] ?? 'image-placeholder.jpg') ?>"
                                 class="card-img-top rounded-top"
                                 alt="<?= $related['pd_nama'] ?>"
                                 style="aspect-ratio: 4/3; object-fit: cover; background: #f8fafc;">
                            <?php if (!empty($related['persentase']) && $related['persentase'] > 0): ?>
                                <span class="position-absolute top-0 start-0 badge bg-danger rounded-end px-3 py-2" style="font-size: 0.9rem; font-weight: 600;">
                                    -<?= $related['persentase'] ?>%
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body pb-3">
                            <h6 class="card-title mb-2" style="font-weight: 600; color: var(--dark-color); min-height: 15px;">
                                <?= $related['pd_nama'] ?>
                            </h6>
                            <div class="d-flex align-items-center mb-2">
                                <?php if (!empty($related['harga_akhir']) && $related['harga_akhir'] < $related['harga']): ?>
                                    <span class="text-muted text-decoration-line-through me-2" style="font-size: 0.95rem;">
                                        Rp <?= number_format($related['harga']) ?>
                                    </span>
                                    <span class="fw-bold text-danger" style="font-size: 1.1rem;">
                                        Rp <?= number_format($related['harga_akhir']) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="fw-bold text-primary" style="font-size: 1.1rem;">
                                        Rp <?= number_format($related['harga']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex align-items-center" style="font-size: 0.95rem;">
                                <span class="text-success"><?= $related['stok'] > 0 ? 'Ready Stock' : 'Out of Stock' ?></span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <style>
        .related-product-card:hover {
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.10), 0 1.5px 4px rgba(0,0,0,0.04);
            transform: translateY(-4px) scale(1.025);
            border-color: var(--primary-color);
        }
        .related-product-card .card-title {
            transition: color .2s;
        }
        .related-product-card:hover .card-title {
            color: var(--primary-color);
        }
    </style>
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