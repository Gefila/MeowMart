  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kategori</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
              <li class="breadcrumb-item active">kategori</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <a class="btn btn-primary mb-2" href="<?= base_url('admin/kategori/tambah') ?>">
          <i class="fa fa-plus"></i> Tambah Kategori
        </a>
        <div class="card-body p-0 card">
          <?php if ($this->session->flashdata('message')) : ?>
            <?= $this->session->flashdata('message'); ?>
          <?php endif; ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">No</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($list_kategori as $kategori):
              ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $kategori['nama']; ?></td>
                  <td>
                    <?= $kategori['deskripsi']; ?>
                  </td>
                  <td>
                    <a type="button" class="btn btn-primary btn-sm" href="<?= base_url('admin/kategori/ubah/') ?><?= $kategori['id_kategori'] ?>"><i class="fa fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteKategori(<?= $kategori['id_kategori']; ?>,'<?= $kategori['nama']; ?>')"><i class="fa fa-trash"></i> Delete</button>
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
    function deleteKategori(id, kategori = 'malas') {
      Swal.fire({
        icon: "warning",
        title: `Apakah anda yakin ingin menghapus kategori ${kategori} ?`,
        text: "Kategori ini akan dihapus",
        showConfirmButton: true,
        confirmButtonText: "Ya, hapus!",
        showCancelButton: true,
        cancelButtonText: "Tidak, batalkan!",
        confirmButtonColor: "#3085d6",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "<?= base_url('admin/kategori/hapus/') ?>" + id;
        }
      });
    }
  </script>