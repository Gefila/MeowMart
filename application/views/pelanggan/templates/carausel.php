<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<div class="container mb-3">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="slide-content">
                    <img src="<?= base_url('assets/') ?>stylish-men-s-shoes-still-life-men-s-accessories.jpg" alt="Shoes" style="width: 100%; height: 500px; object-fit: cover;">
                    <div class="slide-caption">
                        <h5>Shoes</h5>
                        <p>Mens stylish shoes for every occasion.</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-content">
                    <img src="<?= base_url('assets/') ?>analog-watch-1869928_960_720.jpg" alt="Watch" style="width: 100%; height: 500px; object-fit: cover;">
                    <div class="slide-caption">
                        <h5>Luxury Watch</h5>
                        <p>Perfect blend of style and precision.</p>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="slide-content">
                    <img src="<?= base_url('assets/') ?>alvaro-serrano-pFLNV4gkXsc-unsplash.jpg" alt="Leather Bag" style="width: 100%; height: 500px; object-fit: cover;">
                    <div class="slide-caption">
                        <h5>Leather Bag</h5>
                        <p>Elegant leather bags for your journey.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="swiper-pagination"></div>
        
        <!-- Navigation buttons -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
    .slide-content {
        position: relative;
    }
    
    .slide-caption {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        color: white;
        background: rgba(0, 0, 0, 0.5);
        padding: 15px 20px;
        border-radius: 5px;
    }
    
    .slide-caption h5 {
        margin: 0 0 10px 0;
        font-size: 1.5rem;
        font-weight: bold;
    }
    
    .slide-caption p {
        margin: 0;
        font-size: 1rem;
    }
    
    .swiper-pagination-bullet {
        background: white;
        opacity: 0.7;
    }
    
    .swiper-pagination-bullet-active {
        background: #007bff;
        opacity: 1;
    }
    
    @media (max-width: 768px) {
        .slide-caption {
            display: none;
        }
    }
</style>

<script>
    var swiper = new Swiper('.mySwiper', {
        loop: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'slide',
        speed: 600,
    });
</script>