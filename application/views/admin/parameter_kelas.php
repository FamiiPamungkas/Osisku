	<head>
		  <!-- <link rel="stylesheet" href="<?php echo base_url('public/css/dashboard.css'); ?>"> -->
		  <script src="<?php echo base_url('public/js/dashboard-sub.js') ?>"></script>
		  <style>
		  	.print-error > p{
				margin: 0;
		  	}
		  </style>
	</head>
	<header class="w3-container ajax-result" data-ajax='parameter_kelas' style="padding-top:22px">
      <h5><b><i class="fa fa-university"></i> Parameter Kelas</b></h5>
    </header>

	<main class="content-result">	
		<ul class="list-group box box-info">
			<li class="list-group-item active">
				<b>Apa Itu Parameter Kelas ?</b>
			</li>
			<li class="list-group-item">
				<p class="nomar">	
					Parameter Kelas adalah daftar kelas yang ada di Sekolah
				</p>
			</li>
		</ul>
		<div class="col-md-12 row nopad" style="min-height: 374px">
			<div class="col-md-6 nopad">
				<ul class="list-group box box-info">
					<li class="list-group-item active"><b>Masukkan Kelas</b></li>
					<li>
						<form class="form-group kelas" id="input_kelas" action="" method="post">
							<input type="text" name="kelas" class="form-control" placeholder="Kelas" id="input-kelas" maxlength="6">
							<input type="submit" value="Submit" class="btn btn-success">
						</form>
					</li>
				</ul>
				<div class="alert alert-danger print-error " style="margin-top: 10px;display: none;"></div>
			</div>
			<div class="col-md-6 nopad ">
						<!-- <?php $no = $this->uri->segment('3')+1 ?> -->
				<table id="myTable"	class="col-sm-12 table table-striped table-bordered table-fixed">
					<thead class="col-sm-12">
						<tr>
							<th class="col-sm-6" onclick="sortTable(0)" style="cursor: pointer;">Daftar Kelas Terdaftar</th>
							<th class="col-sm-6" onclick="sortTable(1)" style="cursor: pointer;">Aksi</th>
						</tr>
					</thead>
					<!-- <tbody class="y-scroll">
						<tr>
							<td>VIII B</td>
							<td><span class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</span></td>
						</tr>
						<tr>
							<td>VIII B</td>
							<td><span class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</span></td>
						</tr>
						<tr>
							<td>VIII B</td>
							<td><span class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</span></td>
						</tr>
						<tr>
							<td>VIII B</td>
							<td><span class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</span></td>
						</tr>
						<tr>
							<td>VIII B</td>
							<td><span class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</span></td>
						</tr>						
					</tbody> -->
					<tbody id="ajax-kelas" style="min-height: calc(58 * 5)">
						<?php foreach ($kelas as $kel ): ?>
							<tr>
								<!-- <td><?php echo $no++; ?></td> -->
								<td><?php echo $kel->kelas; ?></td>
								<!-- <td><?php print_r($kelas); ?></td> -->
								<td><span class="btn btn-danger hapus-kelas" data-id='<?php echo $kel->id_kelas ?>'><i class="fa fa-trash"></i> Hapus</span></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<div id="nav-kelas" style="position: absolute;bottom: 0">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
		</div>
	</main>
	<script>
		$(document).ready(function () {
			// body...
			// alert('Oke oke');
			$('#nav-kelas a').click(function () {
				// body...
				$.ajax({
					type	: 'POST',
					url 	: $(this).attr('href'),
					success : function (result) {
						// body...
						$('#ajax-container').html(result);
					}
				});
				return false;
			});
			
			$('.hapus-kelas').click(function () {
				// body...
				var page = $('#nav-kelas strong').html();
				if ( page == 1) {
					var num_data = 1;
				}else{
					var num_data = (page-1)*5;
				}

				var data_id = {id : $(this).attr('data-id')};
				// alert(num_data);
				// var	
				$.ajax({
					type	: 'POST',
					url 	: 'Admin/hapus_kelas',
					data 	: data_id,
					success : function (result) {
						// body...
						$('#ajax-container').html(result);
						
						// refresh('Admin/Parameter_kelas');
					}
				});

			});
			// $('.hapus-kelas').click(function () {
			// 	// body...
			// 	alert('Hello '+ id);

			// 	$.ajax({
			// 		type	: 'POST',
			// 		url 	: 'Admin/hapus_kelas', 
			// 		data 	: data_id,
			// 		success : function (result) {
			// 			refresh(dari);
			// 			// body...
			// 			// $('#ajax-container').html(result);

			// 		}


			// 	});
			// })

			
		})
	</script>	

