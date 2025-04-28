  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<div class="content-header">
  		<div class="container-fluid">
  			<div class="row mb-2">
  				<div class="col-sm-6">
  					<h1 class="m-0">Tambah Produk</h1>
  				</div><!-- /.col -->
  				<div class="col-sm-6">
  					<ol class="breadcrumb float-sm-right">
  						<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
  						<li class="breadcrumb-item active">Tambah Produk</li>
  					</ol>
  				</div><!-- /.col -->
  			</div><!-- /.row -->
  		</div><!-- /.container-fluid -->
  	</div>
  	<!-- /.content-header -->

  	<div class="content">
  		<div class="container-fluid">
  			<form method="post" enctype="multipart/form-data">
  				<div class="card card-body">
  					<div class="form-group ">
  						<label for="nama_produk">Nama Produk</label>
  						<input type="text" class="form-control <?= (form_error('nama_produk')) ? 'is-invalid' : ''; ?>" id="nama_produk" name="nama_produk" placeholder="Masukkan Produk">
  						<small class="text-danger mb-0"><?= strip_tags(form_error('nama_produk')); ?></small>
  					</div>
  					<div class="form-group ">
  						<label for="kategori_produk">Kategori Produk</label>
  						<select class="form-control" name="kategori_produk" id="kategori_produk">
  							<option value="" selected disabled>--Pilih Kategori--</option>
  							<?php foreach ($list_kategori as $kategori) : ?>
  								<option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama'] ?></option>
  							<?php endforeach; ?>
  						</select>
  						<small class="text-danger mb-0"><?= strip_tags(form_error('kategori_produk')); ?></small>
  					</div>
  					<div class="form-group ">
  						<label for="harga_produk">Harga Produk</label>
  						<div class="input-group">
  							<div class="input-group-prepend">
  								<span class="input-group-text">Rp</span>
  							</div>
  							<input type="number" class="form-control" name="harga_produk" id="harga_produk" placeholder="Masukkan Harga Produk">
  							<div class="input-group-append">
  								<span class="input-group-text">.00</span>
  							</div>
  						</div>
  						<small class="text-danger mb-0"><?= strip_tags(form_error('harga_produk')); ?></small>
  					</div>
  					<div class="form-group ">
  						<label for="stok_produk">Stok Produk</label>
  						<input type="number" class="form-control <?= (form_error('stok_produk')) ? 'is-invalid' : ''; ?>" id="stok_produk" name="stok_produk" placeholder="Masukkan Produk">
  						<small class="text-danger mb-0"><?= strip_tags(form_error('stok_produk')); ?></small>
  					</div>
  					<div class="form-group ">
  						<label for="gambar_produk">Gambar Produk</label>
  						<div class="input-group">
  							<div class="custom-file">
  								<input type="file" class="form-control custom-file-input <?= (form_error('gambar_produk')) ? 'is-invalid' : ''; ?>" id="gambar_produk" name="gambar_produk[]" multiple placeholder="Masukkan Produk">
  								<label class="custom-file-label" for="gambar_produk">Pilih Gambar</label>
  							</div>
  						</div>
  						<small class="text-danger mb-0"><?= strip_tags(form_error('gambar_produk')); ?></small>
  					</div>
  					<div class="form-group">
  						<label>Deskripsi Produk</label>
  						<textarea class="form-control" rows="10" col="30" name="deskripsi_produk" placeholder="Masukkan Deskripsi Produk"></textarea>
  					</div>
  					<div>
  						<a href="<?= base_url('admin/produk') ?>" class="btn btn-danger">
  							<i class="fa fa-arrow-left"></i> Kembali
  						</a>
  						<button class="btn btn-primary">
  							<i class="fa fa-plus"></i> Tambah produk
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

  <script>
  	// JavaScript untuk mengubah label input file secara dinamis
  	document.querySelector('#gambar_produk').addEventListener('change', function(e) {
  		var fileName = Array.from(this.files).map(f => f.name).join(', ');
  		var nextSibling = e.target.nextElementSibling;
  		nextSibling.innerText = fileName || 'Pilih Gambar'; // Default jika gak ada file
  	});
  </script>