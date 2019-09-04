<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>First Login</title>
	<link rel="stylesheet" href="<?php echo base_url('framework/css/bootstrap.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/css/firstlogin.css') ?>">
	<script src="<?php echo base_url('framework/js/jquery-3.3.1.min.js') ?>"></script>
	<script src="<?php echo base_url('framework/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('framework/js/fontawesome-all.min.js') ?>"></script>
</head>
<body>
	<div class="col-md-6 " style="margin:5% auto; ">
		<div class="card card-default">
			<div class="card-title row nomar">
				<div class="img-title">
					<img src="<?php echo base_url('public/img/main/osis.png') ?>" alt="">	
				</div>
				<div class="text-title">
					<h3 class="momar">Selamat Datang di Osisku</h3>
				</div>
			</div>
			<div class="card-body">
				<div class="card bg-primary text-white">
					<div class="card-header">
						<h5>Sebelum anda melanjutkan, anda harus mengisi satu data Admin terlebih dahulu :</h5>
					</div>
					<div class="card-body bg-light">
						<?php 
							if (validation_errors()) { ?>
								<div class="alert alert-danger error-message">
									<?php echo validation_errors(); ?>
								</div>
						<?php } ?>

								<?php if (isset($error)): ?>
									<div class="alert alert-danger error-message">
										<?php echo $error; ?>
									</div>
								<?php endif ?>


							<?php echo form_open_multipart('First_login/input_admin'); ?>
							<div class="input-admin">
								<input type="text" placeholder="Nomor Induk" name="username" class="form-control">
								<input type="password" placeholder="Password" name="password" class="form-control">
								<input type="password" placeholder="Konfirmasi Password" name="confirm" class="form-control">
								<input type="text" placeholder="Nama Lengkap" name="nama" class="form-control">
								<input type="text" placeholder="Tempat Lahir" name="tmptlahir" class="form-control">
								<div class="card-body bg-light">
									<label for="posisi" class="text-dark"> Tanggal Lahir :</label>
									<input type="date" name="tgllahir" class="form-control">
								</div>
												
								<div class="card-body bg-light" style="padding-top: 0">
									<label for="posisi" class="text-dark"> Posisi / Jabatan :</label>
									<select name="posisi" id="" class="form-control">
										<option value="g">Guru</option>
										<!-- <option value="s">Siswa</option> -->
									</select>
								</div>
								<div class="card-body bg-light row" style="padding-top: 0">
									<div class="col-12">
									<label for="foto" class="text-dark">Unggah Foto :</label>
										
									</div>
									<div class="col-6">
										<input name="foto" accept="image/" type="file" class="form-control">
									</div>	
									<div class="col-6 preview">
										<!-- <img src="<?php echo base_url('public/img/profile/user.jpg') ?>" alt=""> -->
										<img src="" id="image" alt="">
										<span id="no-image" class="fa fa-user fa-10x" style="color: #2196F3"></span>
									</div>	
								</div>
								<hr>	
								<input type="submit" class="btn btn-success" class="input-admin">
							</div>
						</form>
					</div>
					<div class="card-footer">
						<h6>Copyright &copy Fame1302</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
	<script>
		$(document).ready(function() {
			$('[name="foto"]').change(function () {
				// body...
				// alert('aree');
				if (this.files && this.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						$('#image').attr('src', e.target.result);
						// body...
					}
					$('#no-image').hide();
					reader.readAsDataURL(this.files[0]);

					$('#image').load(function () {
						if ($('#image').width()==0) {
						alert('Erro');
					};
					});
					
				}else{
					alert('Gagal memuat gambar !');

					
				}

			});

		});

		function load_image() {

			// body...
		}
	</script>
</html>