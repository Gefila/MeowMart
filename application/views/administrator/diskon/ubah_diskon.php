  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<div class="content-header">
  		<div class="container-fluid">
  			<div class="row mb-2">
  				<div class="col-sm-6">
  					<h1 class="m-0">Ubah Diskon</h1>
  				</div><!-- /.col -->
  				<div class="col-sm-6">
  					<ol class="breadcrumb float-sm-right">
  						<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
  						<li class="breadcrumb-item active">Ubah Diskon</li>
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
  						<label for="nama_diskon">Nama Diskon</label>
  						<input type="text" class="form-control <?= (form_error('nama_diskon')) ? 'is-invalid' : ''; ?>" id="nama_diskon" name="nama_diskon" placeholder="Masukkan Nama Diskon" value="<?= $diskon['nama'] ?>">
  						<small class="text-danger mb-0"><?= strip_tags(form_error('nama_diskon')); ?></small>
  					</div>
  					<div class="form-group ">
  						<label for="persentase_diskon">Jumlah Diskon</label>
  						<input type="number" class="form-control <?= (form_error('persentase_diskon')) ? 'is-invalid' : ''; ?>" id="persentase_diskon" name="persentase_diskon" placeholder="Masukkan Jumlah Diskon" value="<?= $diskon['persentase'] ?>">
  						<small class="text-danger mb-0"><?= strip_tags(form_error('persentase_diskon')); ?></small>
  					</div>
  					<div class="form-group">
  						<label for="deskripsi_diskon">Deskripsi</label>
  						<textarea class="form-control" rows="10" col="30" name="deskripsi_diskon" id="deskripsi_diskon" placeholder="Masukkan Deskripsi Diskon"><?= $diskon['deskripsi'] ?></textarea>
  					</div>
  					<div class="form-group">
  						<label for="tanggal_mulai_diskon">Tanggal Mulai Diskon</label>
  						<input type="date" class="form-control <?= (form_error('tanggal_mulai_diskon')) ? 'is-invalid' : ''; ?>" id="tanggal_mulai_diskon" name="tanggal_mulai_diskon" placeholder="Masukkan Tanggal Mulai Diskon" value="<?= $diskon['tanggal_mulai'] ?>">
  						</label>
  					</div>
  					<div class="form-group">
  						<label for="tanggal_akhir_diskon">Tanggal Akhir Diskon</label>
  						<input type="date" class="form-control <?= (form_error('tanggal_akhir_diskon')) ? 'is-invalid' : ''; ?>" id="tanggal_akhir_diskon" name="tanggal_akhir_diskon" placeholder="Masukkan Tanggal Akhir Diskon" value="<?= $diskon['tanggal_akhir'] ?>">
  						<small class="text-danger mb-0"><?= strip_tags(form_error('tanggal_akhir_diskon')); ?></small>
  					</div>
  					<div class="form-group">
  						<label for="produk">Produk</label>
  						<select class="form-control select2" multiple="multiple" name="produk[]" id="produk" data-placeholder="Pilih Produk" style="width: 100%;">
  							<option value="">Pilih Produk</option>
  							<?php foreach ($list_produk as $produk) : ?>
  								<option value="<?= $produk['id_produk'] ?>" <?= $produk['diskon_id'] === $diskon['id'] ? 'selected' : '' ?>><?= $produk['pd_nama'] ?></option>
  							<?php endforeach; ?>
  						</select>
  					</div>
  					<div>
  						<a href="<?= base_url('admin/diskon') ?>" class="btn btn-danger">
  							<i class="fa fa-arrow-left"></i> Kembali
  						</a>
  						<button class="btn btn-primary">
  							<i class="fa fa-plus"></i> Tambah Diskon
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