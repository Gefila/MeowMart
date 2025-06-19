  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Produk Diskon</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
              <li class="breadcrumb-item active">Produk Diskon</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <a class="btn btn-primary mb-2" href="<?= base_url('admin/produk_diskon/tambah') ?>">
          <i class="fa fa-plus"></i> Tambah Produk Diskon
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
                <th>Produk</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Grouping manual by diskon_id
              $grouped = [];

              foreach ($list_produk_diskon as $row) {
                $grouped[$row['id']]['id'] = $row['id'];
                $grouped[$row['id']]['nama'] = $row['nama'];
                $grouped[$row['id']]['persentase'] = $row['persentase'];
                $grouped[$row['id']]['deskripsi'] = $row['deskripsi'];
                $grouped[$row['id']]['tanggal_mulai'] = $row['tanggal_mulai'];
                $grouped[$row['id']]['tanggal_akhir'] = $row['tanggal_akhir'];
                $grouped[$row['id']]['produk'][] = $row['pd_nama']; // 'nama_produk' kamu sebut sebagai 'nama' di hasil dump
              }
              ?>
              <?php $no = 1;
              foreach ($grouped as $produk_diskon):
              ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td>
                    <?= $produk_diskon['nama']; ?>
                  </td>
                  <td>
                    <?= $produk_diskon['persentase']; ?>
                  </td>
                  <td>
                    <?= $produk_diskon['deskripsi']; ?>
                  </td>
                  <td>
                    <?= $produk_diskon['tanggal_mulai']; ?>
                  </td>
                  <td>
                    <?= $produk_diskon['tanggal_akhir']; ?>
                  </td>
                  <td>
                    <div class="d-flex flex-column" style="gap: 5px;">
                      <?php foreach ($produk_diskon['produk'] as $produk): ?>
                        <span class="badge badge-info"><?= $produk; ?></span>
                      <?php endforeach; ?>
                    </div>
                  </td>
                  <td>
                    <a href="<?= base_url('admin/produk_diskon/ubah/') . $produk_diskon['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteProdukDiskon(<?= $produk_diskon['id']; ?>,'<?= $produk_diskon['nama']; ?>')"><i class="fa fa-trash"></i> Delete</button>
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
    function deleteProdukDiskon(id, produk_diskon = 'malas') {
      Swal.fire({
        icon: "warning",
        title: `Apakah anda yakin ingin menghapus Produk Diskon ${produk_diskon} ?`,
        text: "Produk Diskon ini akan dihapus",
        showConfirmButton: true,
        confirmButtonText: "Ya, hapus!",
        showCancelButton: true,
        cancelButtonText: "Tidak, batalkan!",
        confirmButtonColor: "#3085d6",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "<?= base_url('admin/produk_diskon/hapus/') ?>" + id;
        }
      });
    }
  </script>