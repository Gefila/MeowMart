  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Produk</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
                          <li class="breadcrumb-item active">produk</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
          <div class="container-fluid">
              <a class="btn btn-primary mb-2" href="<?= base_url('admin/produk/tambah') ?>">
                  <i class="fa fa-plus"></i> Tambah Produk
              </a>
              <div class="card-body p-0 card">
                  <?php if ($this->session->flashdata('message')) : ?>
                      <?= $this->session->flashdata('message'); ?>
                  <?php endif; ?>
                  <table class="table table-striped">
                      <thead>
                          <tr>
                              <th style="width: 10px">No</th>
                              <th>Nama</th>
                              <th>Kategori</th>
                              <th>Harga</th>
                              <th>Stok</th>
                              <th>Deskripsi</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $no = 1;
                            foreach ($list_produk as $produk):
                            ?>
                              <tr>
                                  <td><?= $no; ?></td>
                                  <td><?= $produk['pd_nama']; ?></td>
                                  <td><?= $produk['kt_nama']; ?></td>
                                  <td>Rp. <?= number_format($produk['harga']); ?></td>
                                  <td><?= $produk['stok']; ?></td>
                                  <td><?= $produk['deskripsi']; ?></td>
                                  <td>
                                      <a type="button" class="btn btn-primary btn-sm" href="<?= base_url('admin/produk/ubah/') ?><?= $produk['id_produk'] ?>"><i class="fa fa-edit"></i> Edit</a>
                                      <button type="button" class="btn btn-danger btn-sm" onclick="deleteProduk(<?= $produk['id_produk']; ?>,'<?= $produk['pd_nama']; ?>')"><i class="fa fa-trash"></i> Delete</button>
                                  </td>
                              <?php $no++;
                            endforeach; ?>
                              </tr>
                      </tbody>
                  </table>
              </div>
              <!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
      function deleteProduk(id, produk = 'malas') {
          Swal.fire({
              icon: "warning",
              title: `Apakah anda yakin ingin menghapus produk ${produk} ?`,
              text: "Produk ini akan dihapus",
              showConfirmButton: true,
              confirmButtonText: "Ya, hapus!",
              showCancelButton: true,
              cancelButtonText: "Tidak, batalkan!",
              confirmButtonColor: "#3085d6",
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = "<?= base_url('admin/produk/hapus/') ?>" + id;
              }
          });
      }
  </script>