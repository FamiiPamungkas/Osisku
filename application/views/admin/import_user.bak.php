	<link rel="stylesheet" href="<?php echo base_url('public/css/dashboard.css'); ?>">
	<script src="<?php echo base_url('public/js/dashboard-sub.js'); ?>"></script>
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

					<form id="import_user" action="" method="post" enctype="multipart/form-data">
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

		<?php if (isset($data_import)): ?>
			<!-- <div class="">OK</div> -->
			
		<div class="b-layer">
			<div class="card col-10 nopad border-info" style="margin: 5% auto">
				<div class="card-header bg-info" style="color: #fff">
					Import User
					<a href="#" id="close-b-layer" style="position: absolute;right: 20px; color:#fff !important"><i class="fa fa-times"></i></a>
				</div>
				<div class="card-body" style="overflow-y:scroll ; max-height: 400px">
					<div class="alert alert-danger">
						No Induk yang sudah terdaftar tidak akan tersimpan !
					</div>
					<table class="table table-striped">
						<tr>
							<th>Nomor Induk</th>
							<th>Nama Lengkap</th>
							<th>Tempat, Tanggal lahir</th>
							<th>Posisi / Kelas</th>
							<th>Status</th>
						</tr>
						<?php $file = fopen($data_import, 'r'); 
							$array_user = array();
							$array_kelas = array();
						?>
						<?php fgetcsv($file); ?>
						<?php while (($data = fgetcsv($file)) !== false) {
								# code...
							

							echo "<tr class=''>";
							foreach ($data as $row) {
								# code...
								$col = explode(';', $row);

								foreach ($id_user as $usr) {
									# code...
									if ($usr['username']==$col[0]) {
										$status = 'No Induk sudah terdaftar !';
										$class ='exist';
										$stat = 'no';
										break;
									}else{
										$stat = 'ok';
										$act = 'Admin/save_import';
										$status = 'OK';
										$class ='';
									}
								};
								if ($posisi['id_kelas']=='guru') {
									# code...
									$pos = 'g'; 
								}else{
									$pos = 's';
								};

								$tgl = DateTime::createFromFormat('d/m/Y', $col[4]);
								// $tgl_db = DateTime::createFromFormat('Y-m-d', $col[4]);
								$data_user = array(
									'username' => $col[0],
									'password' => $col[2],
									'nama' => $col[1],
									'tempat_lahir' => $col[3],
									'tgl_lahir' => $tgl->format('Y-m-d'),
									'foto' => '',
									'level' => 'u',
									'posisi' => $pos,
									'status' => 'b',
									'id_kelas' => $posisi['id_kelas'],
									'import' => $stat
								);

								array_push($array_user, $data_user);

								echo "<td>".$col[0]."</td>";
								echo "<td>".$col[1]."</td>";
								echo "<td>".$col[3].', '. $tgl->format('d M Y')."</td>";
								echo "<td>".$posisi['kelas']."</td>";
								echo "<td class=".$class.">".$status."</td>";
							}




							echo "</tr>";
						};
						
						 ?>
					</table>

	
				</div>
				<div class="card-footer">
					
					<a href="" class="btn btn-success" id="save_all">Selesai</a>
				</div>
			</div>
		</div>
		<?php endif ?>

		<script>
			$(document).ready(function() {
				// body...
				var array_import = <?php echo json_encode($array_user); ?>;
				// alert(array_import);

				$('#save_all').click(function(event) {
					// body...
					event.preventDefault();

					for (var i = 0; i < array_import.length; i++) {

						// alert(array_import[i].username);
						if (array_import[i].import == 'no') {
							// alert('tidak');
						}else{
							// alert('bisa');
							input_data(array_import[i]);
							
						}


					};

					delete_temp();
					$('.b-layer').hide();

				})

				$('#close-b-layer').click(function () {
					// body...
					$('.b-layer').hide();
				});

				$('.exist').parent().addClass('alert alert-danger').css('background','#F87A85');
			});
			function delete_temp() {
				// body...
				$.ajax({
					url : "Admin/clear_temp",
					success : function (argument) {
						// body...
						// alert('deleted');
					}

				});
			}
			function input_data(array) {
				// body...
				// alert(array.username+' oke');
				$.ajax({
					type : "POST",
					url  : "Admin/save_import",
					data : array,
					// contentType : "application/json; charset=utf-8",
					// dataType : "json",

					success : function (result) {
						// body...
						// alert('berhasilaaa');
					}
				});
			}
		</script>


		
	</main>	

