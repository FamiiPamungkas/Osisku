	<link rel="stylesheet" href="<?php echo base_url('public/css/dashboard.css'); ?>">
	<header class="w3-container ajax-result" data-ajax='import_user' style="padding-top:22px">
      <h5><b><i class="fa fa-file-excel"></i> Import User</b></h5>
    </header>

	<main class="content-result">	
		
		<div class="box box-danger">
			<div class="box-heading box-heading-danger"><b>Instruksi Import Data User</b></div>
			<ul class="list-group">
				<li class="list-group-item">1. Download template csv yang telah disediakan : 
					<a href="<?php echo base_url('public/file/import_user.csv'); ?>" class="btn btn-success"> User</a>
				</li>
				<li class="list-group-item">2. Isi file csv yang telah di download 
					<br><strong>Catatan :</strong>	
					<br><strong>- Jangan Merubah Format File yang di Download</strong>	
					<br><strong>- Pastikan Format Tanggal lahir "dd/mm/yyyy" </strong>	
					<br><strong>- Untuk Siswa dilakukan Upload per Kelas </strong>	
				</li>
				<li class="list-group-item">3. Pilih Kelas yang akan diimport</li> 
				<li class="list-group-item">4. Upload File yang telah diisi </li>
				<li class="list-group-item">5. Klik Upload </li>
				<li class="list-group-item">4. Klik Selesai </li>
			</ul>
		</div>
		<div class="row">
			<div class="col-6 card border-info" style="padding: 0 !important">
				<div class="card-header bg-info">
					<b>Import User</b>
				</div>
				<div class="card-body">
					<?php if (validation_errors()): ?>
						<div class="alert alert-danger" style="padding-bottom: 0">
							<?php echo validation_errors(); ?>
						</div>
					<?php endif ?>
					
					<?php if (isset($error)): ?>
						<div class="alert alert-danger" style="padding-bottom: 0">
							<p><?php echo $error; ?></p>
						</div>
					<?php endif ?>

					<form id="import-user">
						<label for="kelas" class="label">Pilih Kelas / Guru :</label>
						<select name="kelas" id="" class="form-control">
							<option value="">Pilih Kelas / Guru</option>
							<option value="guru">Guru</option>
							<?php foreach ($kelas as $kel): ?>
								<option value="<?php echo $kel['id_kelas'] ?>">
									<?php echo $kel['kelas']; ?>
								</option>
							<?php endforeach ?>
						</select>
						<label for="csv" class="label" style="margin-top: 10px">Upload File :</label>
						<input id="csv" name="csv" type="file" class="form-control" >
						<input style="margin-top: 10px;" type="submit" value="Upload" class="btn btn-info">
					</form>
				</div>
			</div>
		</div>	
		<?php if (isset($data_show)): ?>
			<div class="b-layer">
				<div class="card col-10 nopad border-info" style="margin: 5% auto">
					<div class="card-header bg-info" style="color: #fff">
						Import User
						<a href="#" id="close-b-layer" style="position: absolute;right: 20px; color:#fff !important"><i class="fa fa-times"></i></a>
					</div>
					<div class="card-body" style="overflow-y:scroll ; max-height: 400px">
						<!-- <?php print_r($data_show) ?> -->
						<?php if ($data_show==array()): ?>
							<div class="alert alert-info nomar">
								Semua id yg diimport telah terdaftar !
							</div>
						<?php else: ?>
							<div class="alert alert-info nomar">
								Berikut Data yang berhasil disimpan :
							</div>
							<table class="table table-striped">
								<tr>
									<th>Nomor Induk</th>
									<th>Nama Lengkap</th>
									<th>Tempat, Tanggal lahir</th>
									<th>Posisi / Kelas</th>
									<!-- <th>Status</th> -->
								</tr>
								<?php foreach ($data_show as $show): ?>
									<tr>
										<td><?php echo $show['username']; ?></td>
										<td><?php echo $show['nama']; ?></td>
										<?php 
											$date = strtotime($show['tgl_lahir']);
										 ?>
										<td><?php echo $show['tempat_lahir'].', '.date('d MY',$date); ?></td>
										<?php 
											if ($show['posisi']=='g') {
												$posisi = 'Guru';
											}else{
												$pos = $this->Kelas->get_kelas_by_id($show['posisi']);
												$posisi = $pos['kelas'];
											}
										?>
										<td><?php echo $posisi; ?></td>
									</tr>
								<?php endforeach ?>
							</table>

						<?php endif ?>
					</div>
				</div>
			</div>
		<?php endif ?>	
	</main>	
	<script>
		
		$('#import-user').on('submit',function(e) {
			e.preventDefault();
			// alert('Okee');
			$.ajax({
				url  : 'Admin/import_post',
				type : 'post',
				data : new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success: function (result) {
					$('#ajax-container').html(result);
				}  
			});
		});

		$('.b-layer').click(function () {
			$('.b-layer').hide();

		});
		$('#close-b-layer').click(function () {
			// body...
			$('.b-layer').hide();
		});

	</script>

