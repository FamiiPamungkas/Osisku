	<header class="w3-container ajax-result" data-ajax='kandidat_calon' style="padding-top:22px">
      <h5><b><i class="fa fa-user"></i> Calon</b></h5>
    </header>
	<style>
		.kandidat-calon{
			width: 230px;
			overflow: hidden;
			margin-top: 10px;
			margin-right: 10px;
			height: 380px;
		}
		.img-container{
			height: 250px;
		}
		.kandidat-img{
			width: 100%;
			/*height: 230px !important;*/
		}
		.calon-hapus{
			right: 2px;
			top: 2px;
			background: #fff;
			border-radius: 15px;
			/*z-index: 1000;*/
			/*line-height: 20px;*/
			position: absolute;
		}
		.close-btn{
			position: absolute;
			right: 10px;
			top:10px;
		}
		.trans-layer{
			background: rgba(0,0,0,0.5);
			position: fixed;
			width: 100%;
			height: 100%;
			z-index: 2;
			top: 0;
			left:0;
		}
	</style>
	<?php if (isset($error)): ?>
		<div class="b-layer">
			<div class="card col-4 nopad" style="margin: 15% auto">
				<div class="card-body bg-warning " style="">
					<h5 style="margin: 0"><?php echo $error['title']; ?></h5>
					<span class="btn btn-danger close-btn"><span class="fa fa-times"></span></span>
				</div>
				<div class="card-body">
					<p><?php echo $error['message'] ?></p>
				</div>
			</div>
		</div>
	<?php endif ?>
	<?php if ($pemilihan<>array()): ?>
		<!-- <?php echo date('Y M d'); ?>
		<br>
		<?php echo date('Y M d',strtotime($pemilihan->tgl_mulai)); ?> -->
		<?php if (strtotime('now')>=strtotime($pemilihan->tgl_mulai)): ?>
			
		<div class="trans-layer">
			<div class="alert alert-danger" style="margin: 50px 10px; width: 50%;float: right;">
				<span class="fa fa-exclamation-circle"></span><span> Tidak bisa mengakses kelola kandidat saat Pemilihan Berlangsung</span>
			</div>
		</div>

		<?php endif ?>
	<?php endif ?>
	<main class="container" id="container">
		<hr>
		<div class="card">
			<div class="card-body bg-info text-white">
				<h5>List Calon</h5>
			</div>			
			<div class="card-body">
				<?php foreach ($calon as $daf_calon): ?>
					
					<?php foreach ($siswa as $dat_calon): ?>
						<?php if ($daf_calon['nis']==$dat_calon['username']): ?>
							<?php foreach ($murid as $dat_siswa): ?>
								<?php if ($dat_siswa['nis']==$dat_calon['username']) {
									$id_kel = $dat_siswa['id_kelas'];
									foreach ($kelas as $kls) {
										if ($kls['id_kelas']==$id_kel) {
											$kelas_calon = $kls['kelas'];
										}
									}

								} ?>
							<?php endforeach ?>
							<div class="card kandidat-calon" style="float: left">
								<span class="calon-hapus btn" style="color: red" data-id="<?php echo $dat_calon['username']; ?>">
									<span class="fa fa-times fa-rotate-90"></span>
								</span>
								<div class="img-container">
									<img src="<?php echo base_url($dat_calon['foto']) ?>" class="card-img-top kandidat-img" alt="" onerror="this.onerror=null;this.src='<?php echo base_url('public/img/main/user.png') ?>';">
								</div>
								<div class="card-body bg-secondary text-white">
									<h5 class="card-title"><?php echo $dat_calon['nama'] ?></h5>
									<span class="card-text">NIS : <?php echo $dat_calon['username']; ?></span>
									<br>
									<span class="card-text">Kelas : <?php echo $kelas_calon; ?></span>
								</div>
							</div>

						<?php endif ?>
					<?php endforeach ?>

				<?php endforeach ?>
			</div>
		</div>
		<hr>
		<div class="card">
			<div class="card-body bg-primary text-white">
				<h5 class="nomar">Pilih Calon</h5>
			</div>
			<div class="card-body" style="max-height: 500px;overflow-y: scroll;">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nomor Induk Siswa</th>
							<th>Nama Lengkap</th>
							<th>Tempat, Tanggal lahir</th>
							<th>Kelas</th>
							<th>Pilih</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($siswa as $sis): ?>
							<tr>
								<?php
									foreach ($murid as $mur) {
										# code...
										if ($mur['nis']==$sis['username']) {
											$id_kelas = $mur['id_kelas'];

											foreach ($kelas as $kls) {
												if ($id_kelas==$kls['id_kelas']) {
													$kelasnya = $kls['kelas'];
													# code...
												}

											}
										}
									}

								 ?>
								 

								<td><?php echo $sis['username']; ?></td>
								<td><?php echo $sis['nama']; ?></td>
								<?php $tgl = strtotime($sis['tgl_lahir']); ?>
								<td><?php echo ucfirst($sis['tempat_lahir']).', '.date('d F Y',$tgl); ?></td>
								<!-- <td><?php echo $sis['tempat_lahir'].', '.$sis['tgl_lahir']; ?></td> -->
								<td><?php echo $kelasnya; ?></td>
								<td>
									<?php if ($calon==array()): ?>
										<span class="btn btn-success calon-tambah" data-id="<?php echo $sis['username']; ?>">
											<span class="fa fa-user " ></span>
										</span>
									<?php else: ?>
										<?php foreach ($calon as $cal): ?>
											<?php if ($sis['username']==$cal['nis']) {
												# code...
												$pilih = false;
												break;
											}else{
												$pilih = true;
											}; ?>
										<?php endforeach ?>
										<?php if ($pilih==true): ?>
											<span class="btn btn-success calon-tambah" data-id="<?php echo $sis['username']; ?>">
												<span class="fa fa-users " ></span>
											</span>
										<?php endif ?>
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</main>

<script>
	$(document).ready(function () {
		$('.calon-tambah').click(function () {
			// body...
			var id = { 'id' : $(this).attr('data-id')};
			// alert(id);
			$.ajax({
				type: 'post',
				url : 'Admin/calon_tambah',
				data : id,
				success: function (result) {
					$('#ajax-container').html(result);
				}
			});
		});
		$('.calon-hapus').click(function() {
			// body...
			var id = { 'id' : $(this).attr('data-id')};
			$.ajax({
				type: 'post',
				url : 'Admin/calon_hapus',
				data : id,
				success: function (result) {
					$('#ajax-container').html(result);
				}
			});
		});
		$('.close-btn').click(function() {
			// body...
			$('.b-layer').hide();
		})
	});
	
	function ubah_foto(){
		alert('oke');
	     $(this).attr('src','<?php echo base_url('public/img/main/user.png') ?>');
	};
	
</script>
