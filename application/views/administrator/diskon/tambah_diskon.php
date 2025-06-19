  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<div class="content-header">
  		<div class="container-fluid">
  			<div class="row mb-2">
  				<div class="col-sm-6">
  					<h1 class="m-0">Tambah Diskon</h1>
  				</div><!-- /.col -->
  				<div class="col-sm-6">
  					<ol class="breadcrumb float-sm-right">
  						<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
  						<li class="breadcrumb-item active">Tambah Diskon</li>
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
  						<label for="nama_produk_diskon">Nama Produk Diskon</label>
  						<input type="text" class="form-control <?= (form_error('nama_produk_diskon')) ? 'is-invalid' : ''; ?>" id="nama_produk_diskon" name="nama_produk_diskon" placeholder="Masukkan Nama Produk Diskon">
  						<small class="text-danger mb-0"><?= strip_tags(form_error('nama_produk_diskon')); ?></small>
  					</div>
  					<div class="form-group ">
  						<label for="persentase_produk_diskon">Persentase Diskon</label>
  						<input type="number" class="form-control <?= (form_error('persentase_produk_diskon')) ? 'is-invalid' : ''; ?>" id="persentase_produk_diskon" name="persentase_produk_diskon" placeholder="Masukkan persentase Diskon">
  						<small class="text-danger mb-0"><?= strip_tags(form_error('persentase_produk_diskon')); ?></small>
  					</div>
  					<div class="form-group">
  						<label for="deskripsi_produk_diskon">Deskripsi</label>
  						<textarea class="form-control" rows="10" col="30" name="deskripsi_produk_diskon" id="deskripsi_produk_diskon" placeholder="Masukkan Deskripsi Produk Diskon"></textarea>
  					</div>
  					<div class="form-group">
  						<label for="tanggal_mulai_diskon">Tanggal Mulai Diskon</label>
  						<input type="date" class="form-control <?= (form_error('tanggal_mulai_diskon')) ? 'is-invalid' : ''; ?>" id="tanggal_mulai_diskon" name="tanggal_mulai_diskon" placeholder="Masukkan Tanggal Mulai Diskon">
  						</label>
  					</div>
  					<div class="form-group">
  						<label for="tanggal_akhir_diskon">Tanggal Akhir Diskon</label>
  						<input type="date" class="form-control <?= (form_error('tanggal_akhir_diskon')) ? 'is-invalid' : ''; ?>" id="tanggal_akhir_diskon" name="tanggal_akhir_diskon" placeholder="Masukkan Tanggal Akhir Diskon">
  						<small class="text-danger mb-0"><?= strip_tags(form_error('tanggal_akhir_diskon')); ?></small>
  					</div>
  					<div class="form-group">
  						<label for="produk">Produk</label>
  						<select class="form-control select2" multiple="multiple" name="produk[]" id="produk" data-placeholder="Pilih Produk" style="width: 100%;">
  							<option value="">Pilih Produk</option>
  							<?php foreach ($list_produk as $produk) : ?>
  								<option value="<?= $produk['id_produk'] ?>"><?= $produk['pd_nama'] ?></option>
  							<?php endforeach; ?>
  						</select>
  					</div>
  					<div>
  						<a href="<?= base_url('admin/produk_diskon') ?>" class="btn btn-danger">
  							<i class="fa fa-arrow-left"></i> Kembali
  						</a>
  						<button class="btn btn-primary">
  							<i class="fa fa-plus"></i> Tambah Produk Diskon
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