     <!-- Isi Konten -->
     <style>
         .diskon {
             position: absolute;
             top: 8px;
             right: 16px;
         }
     </style>
     <?php if ($this->session->flashdata('message')): ?>
         <?= $this->session->flashdata('message'); ?>
     <?php endif; ?>
     <div class="container mb-3">
         <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
             <?php foreach (array_slice($list_produk, 0, 8) as $key => $value): ?>
                 <div class="col d-flex">
                     <div class="card shadow-sm h-100 w-100 d-flex flex-column">
                         <?php
                            $gambar = $gambar_model->get_by_produk_id($value['id_produk']);
                            if (empty($gambar)) {
                                $gambar = [['nama_gambar' => 'image-placeholder.jpg']];
                            }
                            ?>
                         <a href="<?= base_url('produk/') . $value['id_produk'] ?>">
                             <img src="<?= base_url('uploads/produk/') . $gambar[0]['nama_gambar']; ?>"
                                 class="card-img-top img-fluid"
                                 alt="..."
                                 style="object-fit: cover; height: 200px;">
                         </a>
                         <div class="card-body d-flex flex-column">
                             <?php if (!empty($value['nama_diskon']) && !empty($value['jumlah_diskon'])): ?>
                                 <div class="diskon mb-2">
                                     <span class="badge bg-danger"><?= $value['nama_diskon'] . " " . $value['jumlah_diskon'] . "%" ?></span>
                                 </div>
                             <?php endif; ?>
                             <a href="<?= base_url('produk/') . $value['id_produk'] ?>" class="text-decoration-none text-dark mb-2">
                                 <h5 class="card-title text-truncate" style="max-width: 100%;"><?= $value['pd_nama'] ?></h5>
                             </a>
                             <div class="mt-auto">
                                 <div class="d-flex justify-content-between align-items-center">
                                     <div class="harga d-flex align-items-baseline" style="color: #333;">
                                         <small class="mr-1">Rp</small>
                                         <?php if (!empty($value['harga_akhir']) && $value['harga_akhir'] < $value['harga']): ?>
                                             <h5 class="mb-0 me-2" style="text-decoration: line-through; color: #888;">
                                                 <?= number_format($value['harga']) ?>
                                             </h5>
                                             <h5 class="mb-0 text-danger">
                                                 <?= number_format($value['harga_akhir']) ?>
                                             </h5>
                                         <?php else: ?>
                                             <h5 class="mb-0"><?= number_format($value['harga']) ?></h5>
                                         <?php endif; ?>
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
         <a type="button" class="btn btn-outline-primary" href="<?= base_url('produk') ?>">Lihat Semua Produk</a>
     </div>