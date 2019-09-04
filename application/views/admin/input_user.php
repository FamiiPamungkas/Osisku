	<head>
		  <script src="<?php echo base_url('public/js/dashboard-sub.js') ?>"></script>
		  <style>
		  	.print-error > p{
				margin: 0;
		  	}
		  	.input-user > input{
		  		margin-bottom: 15px;
		  	}
		  	.input-user > input.:last-child{
				margin: 0;
		  	}
		  	.preview {}
			.error-message > p{
				margin: 0;
				padding: 2px 0;
			}
			.eye-button:hover{
				cursor: pointer;
				color: blue;
			}
			.eye-button{
				position: absolute;
				top: 10px;
				right: 10px;
				color: gray;
			}
		  </style>
	</head>
	<header class="w3-container ajax-result" data-ajax='Input_user' style="padding-top:22px">
      <h5><b><i class="fa fa-edit"></i> Input User</b></h5>
    </header>

	<main class="content-result">	
		<ul class="list-group box box-info">
			<li class="list-group-item active">
				<b>Input User Secara Manual</b>
			</li>
			<li class="list-group-item">
				<p class="nomar">	
					Input user secara manual atau rubah data user yang telah ada.
				</p>
			</li>
		</ul>
		<div class="col-md-12 row nopad" style="min-height: 374px">
			<div class="col-md-8 nopad">
				<ul class="list-group box box-info">
					<li class="list-group-item active"><b>Input User</b></li>
					<li>
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

							<form action="" method="post" enctype="multipart/form-data" id="form">
								
								<div class="input-user">
									<input type="text" placeholder="Nomor Induk" name="username" class="form-control" value="<?php echo isset($form)? $form['username']:'' ?>" 
									<?php if(isset($form)){ echo ($form['mode']=='edit')? 'readonly':'';} ?>>
									<div style="margin-bottom: 15px; position: relative;">
										<input type="password" placeholder="Password" name="password" class="form-control">
										<span class="fa fa-eye eye-button" data-password="eye-open"></span>
										<span class="fa fa-eye-slash eye-button" data-password="eye-close" style="display: none;"></span>
										<input type="checkbox" class="eye-toggle" data-input="password" style="opacity: 0;zoom:1.5;position: absolute;top:5px;right: 5px;">
									</div>
									<div style="margin-bottom: 15px; position: relative;">
										<input type="password" placeholder="Konfirmasi Password" name="confirm" class="form-control">
										<span class="fa fa-eye eye-button" data-confirm="eye-open"></span>
										<span class="fa fa-eye-slash eye-button" data-confirm="eye-close" style="display: none;"></span>
										<input type="checkbox" class="eye-toggle" data-input="confirm" style="opacity: 0;zoom:1.5;position: absolute;top:5px;right: 5px;">
									</div>
									<input type="text" placeholder="Nama Lengkap" name="nama" class="form-control" value="<?php echo isset($form)? $form['nama']:'' ?>">
									<input type="text" placeholder="Tempat Lahir" name="tmptlahir" class="form-control" style="margin: 0;" value="<?php echo isset($form)? $form['tmptlahir']:'' ?>">
									<div class="card-body bg-light">
										<label for="posisi" class="text-dark"> Tanggal Lahir :</label>
										<input type="date" name="tgllahir" class="form-control" value="<?php echo isset($form)? $form['tgllahir']:'' ?>"> 
									</div>
													
									<div class="card-body bg-light" style="padding-top: 0">
										<label for="posisi" class="text-dark"> Posisi / Kelas :</label>
										<select name="posisi" class="form-control">
											<option value="g" <?php if (isset($form)) { echo ($form['posisi']=='g')? 'selected':''; } ?>>Guru</option>
											<?php foreach ($kelas as $kls): ?>
											<option value="<?php echo $kls['id_kelas'] ?>" <?php if (isset($form)){ echo ($form['posisi']==$kls['id_kelas'])? 'selected':''; } ?>><?php echo $kls['kelas'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="card-body bg-light" style="padding-top: 0">
										<label for="posisi" class="text-dark"> Level User :</label>
										<select name="level" class="form-control">
											<option value="u" >User</option>
											<option value="a" <?php if (isset($form)) { echo ($form['level']=='a')? 'selected':''; }?>>Admin</option>
										</select>
									</div>
									<div class="card-body bg-light row" style="padding-top: 0">
										<div class="col-12">
										<label for="foto" class="text-dark">Unggah Foto :</label>
											
										</div>
										<div class="col-6">
											<input name="foto" accept="image/" type="file" class="form-control">
											<label for=""><small style="color:red">*Ukuran Foto max 5MB</small></label>
										</div>	
										<div class="col-6 preview">
											<!-- <img src="<?php echo base_url('public/img/profile/user.jpg') ?>" alt=""> -->
											<img src="<?php if(isset($form)) { echo $form['foto']; }  ?>" id="user-image" alt="" class="" style="width: 100%;" onerror="ubah_gambar()">
											<!-- <span id="no-image" class="fa fa-user fa-10x" style="color: #2196F3"></span> -->
										</div>	
									</div>
									<hr>	
									<input type="hidden" value="<?php if(isset($form)) {echo $form['mode']; } ?>" name="mode">
									<input type="submit" class="btn btn-success" id="simpan" class="input-admin">
								</div>
							</form>
						</div>
					</li>
				</ul>
				<div class="alert alert-danger print-error " style="margin-top: 10px;display: none;"></div>
			</div>
			<div class="col-md-4 nopad ">
				
			</div>
		</div>
	</main>
	<?php if (isset($info)): ?>
		
	<div class="b-layer" id="b-layer">
		<div class="list-group box box-info col-6 nopad info-popup" style="">
			<div class="list-group-item active info-title">
				<b><?php echo $info['title'] ?></b>
			</div>
			<div class="list-group-item info-message">
				<p class="nomar">	
					<?php echo $info['message']; ?>
				</p>
			</div>
		</div>
	</div>

	<?php endif ?>
	<script>
		$(document).ready(function () {
			$('[name="foto"]').change(function () {
				// body...
				// alert('aree');
				if (this.files && this.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						$('#user-image').attr('src', e.target.result);
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
			
			$('#form').on('submit',(function (e) {
				e.preventDefault();
				$.ajax({
					url: 'Admin/simpan_user',
					type : 'post',
					data : new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					success: function (result) {
						$('#ajax-container').html(result);
					}  
				});
				// body...
			}));

			$('input:checkbox').click(function () {

				if ($(this).is(':checked')) {
					// alert('[data-check="'+$(this).attr('data-input')+'"]');
					$('[name="'+$(this).attr('data-input')+'"]').attr('type','text');
					$('[data-'+$(this).attr('data-input')+'="eye-open"]').hide();
					$('[data-'+$(this).attr('data-input')+'="eye-close"]').show();
				}else{
					// alert('[name="'+$(this).attr('data-input')+'"]');
					$('[name="'+$(this).attr('data-input')+'"]').attr('type','password');
					$('[data-'+$(this).attr('data-input')+'="eye-close"]').hide();
					$('[data-'+$(this).attr('data-input')+'="eye-open"]').show();
				}
			});

			$('#b-layer').click(function () {
				$('#b-layer').fadeOut(500);    
			})

			
			

		});

		function ubah_gambar() 
	  	{
	     	$('#user-image').attr('src','<?php echo base_url('public/img/main/user.png') ?>');
	  	}
		
	</script>	

