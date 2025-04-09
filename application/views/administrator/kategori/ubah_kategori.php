  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<div class="content-header">
  		<div class="container-fluid">
  			<div class="row mb-2">
  				<div class="col-sm-6">
  					<h1 class="m-0">Tambah Kategori</h1>
  				</div><!-- /.col -->
  				<div class="col-sm-6">
  					<ol class="breadcrumb float-sm-right">
  						<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
  						<li class="breadcrumb-item active">Tambah Kategori</li>
  					</ol>
  				</div><!-- /.col -->
  			</div><!-- /.row -->
  		</div><!-- /.container-fluid -->
  	</div>
  	<!-- /.content-header -->

  	<div class="content">
  		<div class="container-fluid">
  			<form method="post">
  				<div class="card card-body">
  					<div class="form-group ">
  						<label for="exampleInputEmail1">Nama Kategori</label>
  						<input type="text" class="form-control <?= (form_error('nama_kategori')) ? 'is-invalid' : ''; ?>" id="nama_kategori" name="nama_kategori" placeholder="Masukkan Kategori" value="<?= $kategori['nama'] ?>">
  						<small class="text-danger mb-0"><?= strip_tags(form_error('nama_kategori')); ?></small>
  					</div>
  					<div class="form-group">
  						<label>Deskripsi Kategori</label>
  						<textarea class="form-control" rows="10" col="30" name="deskripsi_kategori" placeholder="Masukkan Deskripsi Kategori"><?= $kategori['deskripsi'] ?></textarea>
  						</textarea>
  					</div>
  					<div>
  						<button class="btn btn-primary">
  							<i class="fa fa-edit"></i> Edit Kategori
  						</button>
  					</div>
  				</div>
  			</form>
  			<!-- /.row -->
  		</div><!-- /.container-fluid -->
  	</div>
  	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->