	<style>
		.user-data > .row{
			margin-bottom: 10px;
		}
		
		.data-user{
			position: absolute;
			top: 25%;
			left: 25%;
		}
	</style>
	<header class="w3-container ajax-result" data-ajax='lihat_user' style="padding-top:22px">
      <h5><b><i class="fa fa-users"></i> Daftar User</b></h5>
    </header>
	
	<main class="container" id="container" data-source="<?php echo $source = (isset($_GET['source'])) ? $_GET['source'] : '' ; ?>">
		<div class="card" style="margin-bottom: 10px;flex-direction: unset;">
			<span style="padding: 10px;float: left;width: auto;">Filter :</span>
			<select name="user_filter" id="user_filter" class="form-control" style="width: 30%;margin: 5px" onchange="user_filter()">
				<option value="">Semua</option>
				<?php $check = ($id_kelas=='guru') ? 'selected' : '' ; ?>
				<option value="guru" <?php echo $check; ?>>Guru</option>
				<?php foreach ($kelas as $kel): ?>
				<?php if ($kel['id_kelas']==$id_kelas) {
					$check = 'selected';}else{$check = '';} ?>
				<option value="<?php echo $kel['id_kelas'] ?>" <?php echo $check; ?>><?php echo $kel['kelas']; ?></option>

				<?php endforeach ?>
			</select>
		</div>
		<table class="table table-striped">
			<tr style="border: 1px solid gray">
				<th>Nomor Induk</th>
				<th>Nama Lengkap</th>
				<th>Tempat, Tgl Lahir</th>
				<th>Posisi / Kelas</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
			<?php if (count($user)==0): ?>
				
			<tr>
				<th colspan="6" class="alert-danger">
					<h3 >Data Tidak Ditemukan</h3>
				</th>
			</tr>
			<?php endif ?>

			<?php foreach ($user as $row): ?>
				<?php 

					if ($row['status']=='s') {
						$status = 'Sudah Voting';
						$stat_class = 'bg-success';
					}else{
						$status = 'Belum Voting';
						$stat_class = 'bg-danger';
					};

					if ($row['posisi']=='s') {
						foreach ($siswa as $sis) {
							if ($sis['nis']==$row['username']) {
					 			$pos=$sis['id_kelas'];
								
								foreach ($kelas as $kls) {
									if ($kls['id_kelas']==$pos) {
											$posisi = $kls['kelas'];
											$id_kelas = $pos;
										}	
								
								}

								}	
						};

					 }else{
						$id_kelas = 'guru';
					 	$posisi='Guru';
					 }

				?>
				<tr class="user-row" style="border: 1px solid transparent" data-id="<?php echo $row['username'] ?>">
					<td><?php echo $row['username'].' '; 
							if ($row['level']=='a') {
						# code...
								echo "<span class='bg-success notice-text'>admin</span>";
							}
					?></td>
					<td><?php echo ucwords($row['nama']); ?></td>
					<?php $tgl = strtotime($row['tgl_lahir']); ?>
					<td><?php echo ucfirst($row['tempat_lahir']).', '.date('d F Y',$tgl); ?></td>
					<td><?php echo $posisi; ?></td>
					<td><?php echo "<span class='".$stat_class. " notice-text'>".$status."</span>" ?></td>	
					<td>
						<a href="" class="notice-text bg-warning edit-user" 
						data-id="<?php echo $row['username'] ?>"
						data-kls="<?php echo $id_kelas ?>"

						><span class="fa fa-edit"></span></a>
						<a href="" class="notice-text bg-danger delete-user" data-id=" <?php echo $row['username'] ?>"><span class="fa fa-trash"></span></a>

					</td>
				</tr>
			<?php endforeach ?>
		</table>
		<div class="card" style="padding: 10px">
			<div id="nav-kelas" style="">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>

		
	<div class="b-layer" id="b-layer" style="display: none;">
		
	</div>


	</main>	
	<script>
		$(document).ready(function(argument) {
			
			
			$('#nav-kelas a').click(function () {
				// body...
				var data = 'dadada';
				$.ajax({
					type	: 'GET',
					data 	: {source:$(this).attr('href')},
					url 	: $(this).attr('href'),
					success : function (result,data) {
						// body...
						$('#ajax-container').html(result);
						// $('#ajax-container').attr('data-source',data);
					}
				});
				return false;
			});

			$('.edit-user').click(function() {
				// body...
				// alert('ini edit');
				var formData = { id :$(this).attr('data-id')};
				// alert(id_user); 
				$.ajax({
					type : 'post',
					url  : 'Admin/edit_user',
					data : formData,
					success : function (result) {
						// body...
						$('#ajax-container').html(result);
						
					}
				});
				return false;
			});

			$('.delete-user').click(function() {
				// body...
				var id_user = $(this).attr('data-id');
				var kls = $('#user_filter option:checked').val();
				var alamat = $('#container').attr('data-source');
				// alert(kls);
				var data_array = { id : id_user, kelas : kls, link : alamat };
				// alert('ini delete '+id_user);
				$.ajax({
					type	: 'POST',
					data 	: data_array,
					url 	: 'Admin/delete_user',
					success : function (result) {
						$('#ajax-container').html(result);

					}

				});

				return false;
			});

			$('.user-row').click(function () {
				// body...
				var Formdata = { id : $(this).attr('data-id') };

				$.ajax({
					type: 'post',
					data: Formdata,
					url: 'User/profile_user',
					success:function (result) {
						$('#b-layer').html(result);
						$('#b-layer').show();
					}
				});
				// $('[data-user="foto"]').attr('src','public/img/profile/'+id+'.jpg');

			});
				
			$('#b-layer').click(function () {
				$('#b-layer').hide();    
			});

		});

		function user_filter() {
			// body...
			var filter = $("#user_filter option:checked").val();
			var filter_array = {
				kelas 	: filter
			};

			// alert('use filter');
			$.ajax({
				type	: 'POST',
				data 	: filter_array,
				url 	: 'Admin/lihat_user_filter',
				success : function (result) {
					// body...
						$('#ajax-container').html(result);
				}

			});
		}
	</script>
