  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Diskon</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
              <li class="breadcrumb-item active">Diskon</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <a class="btn btn-primary mb-2" href="<?= base_url('admin/diskon/tambah') ?>">
          <i class="fa fa-plus"></i> Tambah Diskon
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
                <th>Jumlah</th>
                <th>Deskripsi</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Akhir</th>
                <th>Status</th>
                <th>Produk</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($list_diskon as $diskon):
              ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td>
                    <?= $diskon['nama']; ?>
                  </td>
                  <td>
                    <?= $diskon['persentase']; ?>
                  </td>
                  <td>
                    <?= $diskon['deskripsi']; ?>
                  </td>
                  <td>
                    <?= indo_date($diskon['tanggal_mulai']); ?>
                  </td>
                  <td>
                    <?= indo_date($diskon['tanggal_akhir']); ?>
                  </td>
                  <td>
                    <?php if ($diskon['status'] == 'aktif'): ?>
                      <span class="badge badge-success">Aktif</span>
                    <?php else: ?>
                      <span class="badge badge-danger">Tidak Aktif</span>
                    <?php endif; ?>
                  <td>
                    <ul class="list-unstyled">
                      <?php foreach ($diskon['produk'] as $produk): ?>
                        <li><?= $produk['nama_produk']; ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </td>
                  <td>
                    <a href="<?= base_url('admin/diskon/ubah/') . $diskon['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteProdukDiskon(<?= $diskon['id']; ?>,'<?= $diskon['nama']; ?>')"><i class="fa fa-trash"></i> Delete</button>
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
    function deleteProdukDiskon(id, diskon = 'malas') {
      Swal.fire({
        icon: "warning",
        title: `Apakah anda yakin ingin menghapus Diskon ${diskon} ?`,
        text: "Diskon ini akan dihapus",
        showConfirmButton: true,
        confirmButtonText: "Ya, hapus!",
        showCancelButton: true,
        cancelButtonText: "Tidak, batalkan!",
        confirmButtonColor: "#3085d6",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "<?= base_url('admin/diskon/hapus/') ?>" + id;
        }
      });
    }
  </script>