  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	<?php if ($this->session->flashdata('message')) : ?>
  		<?= $this->session->flashdata('message'); ?>
  	<?php endif; ?>
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
  						<li class="breadcrumb-item active">Tambah Kategori</li>
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
  						<input type="text" class="form-control <?= (form_error('nama_produk')) ? 'is-invalid' : ''; ?>" id="nama_produk" name="nama_produk" placeholder="Masukkan Produk" value="<?= $produk['pd_nama'] ?>">
  						<small class="text-danger mb-0"><?= strip_tags(form_error('nama_produk')); ?></small>
  					</div>
  					<div class="form-group ">
  						<label for="kategori_produk">Kategori Produk</label>
  						<select class="form-control" name="kategori_produk" id="kategori_produk" value="<?= $produk['categori_id'] ?>">
  							<option value="" selected disabled>--Pilih Kategori--</option>
  							<?php foreach ($list_kategori as $kategori) : ?>
  								<option <?= ($produk['categori_id'] == $kategori['id_kategori']) ? "selected" : "" ?> value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama'] ?></option>
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
  							<input type="number" class="form-control" name="harga_produk" id="harga_produk" placeholder="Masukkan Harga Produk" value=<?= $produk['harga'] ?>>
  							<div class="input-group-append">
  								<span class="input-group-text">.00</span>
  							</div>
  						</div>
  						<small class="text-danger mb-0"><?= strip_tags(form_error('harga_produk')); ?></small>
  					</div>
  					<div class="form-group ">
  						<label for="stok_produk">Stok Produk</label>
  						<input type="number" class="form-control <?= (form_error('stok_produk')) ? 'is-invalid' : ''; ?>" id="stok_produk" name="stok_produk" placeholder="Masukkan Produk" value="<?= $produk['stok'] ?>">
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
  					<?php $list_gambar = $gambar_model->get_by_produk_id($produk['id_produk']); ?>
  					<div class="row mb-3">
  						<?php foreach ($list_gambar as $gambar) : ?>
  							<div class="col-lg-3 card card-body m-2">
  								<img src="<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>" class="img-thumbnail" alt="Gambar Produk" width="100%">
  								<div class="d-flex flex-row mt-auto" style="gap: 15px;">
  									<a href="<?= base_url('admin/produk/ubah_gambar/' . $gambar['id_gambar']) ?>"
  										class="btn btn-warning btn-sm mt-1 flex-fill btn-ubah-gambar"
  										data-id="<?= $gambar['id_gambar'] ?>"
  										data-image="<?= base_url('uploads/produk/' . $gambar['nama_gambar']) ?>">
  										<i class="fa fa-edit"></i> Ubah
  									</a>
  									<button type="button" class="btn btn-danger btn-sm mt-1 flex-fill" onclick="deleteGambar(<?= $gambar['id_gambar'] ?>,'<?= $gambar['nama_gambar'] ?>')">
  										<i class="fa fa-trash"></i> Hapus
  									</button>
  								</div>
  							</div>
  						<?php endforeach; ?>
  					</div>
  					<div class="form-group">
  						<label>Deskripsi Produk</label>
  						<textarea class="form-control" rows="10" col="30" name="deskripsi_produk" placeholder="Masukkan Deskripsi Produk"><?= $produk['deskripsi'] ?></textarea>
  					</div>
  					<div>
  						<a href="<?= base_url('admin/produk') ?>" class="btn btn-danger">
  							<i class="fa fa-arrow-left"></i> Kembali
  						</a>
  						<button class="btn btn-primary ml-2">
  							<i class="fa fa-edit"></i> Edit Produk
  						</button>
  					</div>
  				</div>
  			</form>
  			<!-- /.row -->
  		</div><!-- /.container-fluid -->
  		<!-- Modal for Image Update -->
  		<div class="modal fade" id="modalUbahGambar" tabindex="-1" role="dialog" aria-labelledby="modalUbahGambarLabel" aria-hidden="true">
  			<div class="modal-dialog" role="document">
  				<div class="modal-content">
  					<div class="modal-header">
  						<h5 class="modal-title" id="modalUbahGambarLabel">Ubah Gambar Produk</h5>
  						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
  						</button>
  					</div>
  					<form id="formUbahGambar" action="" method="post" enctype="multipart/form-data">
  						<div class="modal-body">
  							<div class="text-center mb-3">
  								<img id="currentImage" src="" class="img-fluid rounded" alt="Gambar Produk" style="max-height: 200px;">
  							</div>
  							<div class="form-group">
  								<label for="gambar_produk_update">Pilih Gambar Baru</label>
  								<div class="input-group">
  									<div class="custom-file">
  										<input type="file" class="form-control custom-file-input" id="gambar_produk_update" name="gambar_produk" required>
  										<label class="custom-file-label" for="gambar_produk_update">Pilih gambar</label>
  									</div>
  								</div>
  								<small class="text-muted">Format: jpg, jpeg, png, gif. Ukuran maks: 5MB</small>
  							</div>
  							<div id="preview-container" class="text-center mt-3 d-none">
  								<p>Preview:</p>
  								<img id="image-preview" src="#" class="img-fluid rounded" style="max-height: 200px;">
  							</div>
  						</div>
  						<div class="modal-footer">
  							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
  							<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
  						</div>
  					</form>
  				</div>
  			</div>
  		</div>
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

  	$(document).ready(function() {
  		// Handle showing modal and setting form action
  		$('.btn-ubah-gambar').click(function(e) {
  			e.preventDefault();
  			var imageId = $(this).data('id');
  			var imageUrl = $(this).data('image');
  			var updateUrl = $(this).attr('href');

  			// Set the current image
  			$('#currentImage').attr('src', imageUrl);

  			// Set the form action URL
  			$('#formUbahGambar').attr('action', updateUrl);

  			// Reset preview
  			$('#preview-container').addClass('d-none');
  			$('#image-preview').attr('src', '');

  			// Show the modal
  			$('#modalUbahGambar').modal('show');
  		});

  		// Show image preview when a new file is selected
  		$('#gambar_produk_update').change(function() {
  			if (this.files && this.files[0]) {
  				var reader = new FileReader();

  				reader.onload = function(e) {
  					$('#image-preview').attr('src', e.target.result);
  					$('#preview-container').removeClass('d-none');
  				}

  				reader.readAsDataURL(this.files[0]);

  				// Update file input label
  				var fileName = $(this).val().split('\\').pop();
  				$(this).next('.custom-file-label').addClass('selected').html(fileName);
  			}
  		});
  	});


  	function deleteGambar(id, image) {
  		Swal.fire({
  			icon: "warning",
  			title: `Apakah anda yakin ingin menghapus gambar ?`,
  			text: "Gambar ini akan dihapus",
  			showConfirmButton: true,
  			imageUrl: "<?= base_url('uploads/produk/') ?>" + image,
  			imageWidth: 400,
  			imageHeight: 200,
  			confirmButtonText: "Ya, hapus!",
  			showCancelButton: true,
  			cancelButtonText: "Tidak, batalkan!",
  			confirmButtonColor: "#3085d6",
  		}).then((result) => {
  			if (result.isConfirmed) {
  				window.location.href = "<?= base_url('admin/produk/hapus_gambar/') ?>" + id;
  			}
  		});
  	}
  </script>