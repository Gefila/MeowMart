     <!-- Isi Konten -->
     <style>
         .diskon {
             position: absolute;
             top: 8px;
             right: 16px;
         }
     </style>
     <div class="container mb-3">
         <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
             <?php foreach ($list_produk as $key => $value): ?>
                 <div class="col d-flex">
                     <div class="card shadow-sm h-100 w-100 d-flex flex-column">
                         <?php
                            $gambar = $gambar_model->get_by_produk_id($value['id_produk']);
                            ?>
                         <a href="<?= base_url('produk/') . $value['id_produk'] ?>">
                             <img src="<?= base_url('uploads/produk/') . $gambar[0]['nama_gambar']; ?>"
                                 class="card-img-top img-fluid"
                                 alt="..."
                                 style="object-fit: cover; height: 200px;">
                         </a>
                         <div class="card-body d-flex flex-column">
                             <div class="diskon mb-2">
                                 <span class="badge badge-primary">Lebaran.20%</span>
                             </div>
                             <a href="<?= base_url('produk/') . $value['id_produk'] ?>" class="text-decoration-none text-dark mb-2">
                                 <h5 class="card-title text-truncate" style="max-width: 100%;"><?= $value['pd_nama'] ?></h5>
                             </a>
                             <div class="mt-auto">
                                 <div class="d-flex justify-content-between align-items-center">
                                     <div class="harga d-flex align-items-baseline" style="color: #333;">
                                         <small class="mr-1">Rp</small>
                                         <h5 class="mb-0"><?= number_format($value['harga']) ?></h5>
                                     </div>
                                     <small class="text-muted">2 terjual</small>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             <?php endforeach ?>
         </div>
     </div>

     <div class="container mt-4 text-center">
         <button type="button" class="btn btn-outline-primary">Lihat Semua Produk</button>
     </div>