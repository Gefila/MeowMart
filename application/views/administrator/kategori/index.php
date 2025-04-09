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
        <div class="card-body p-0">
          <a class="btn btn-primary" href="<?= base_url('admin/kategori/tambah') ?>">
            <i class="fa fa-plus"></i> Tambah Kategori
          </a>
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
                    <a type="button" class="btn btn-primary btn-sm" href="<?= base_url('admin/kategori/ubah/')?>"><i class="fa fa-edit"></i> Edit</a>
                    <a type="button" class="btn btn-danger btn-sm" href="<?= base_url('admin/kategori/hapus/')?><?= $kategori['id_kategori'] ?>"><i class="fa fa-trash"></i> Delete</a>
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