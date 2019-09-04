<div class="list-group box box-info col-6 nopad data-user" id="data-user" style="">
		<div class="list-group-item active info-title">
				<b>Data Lengkap User</b>
			</div>
			<div class="list-group-item info-message">
				<div class="col-12 row nopad" style="margin: 10px 0; ">
					
					<div class="col-4">
						<img src="<?php echo base_url($user->foto) ?>" alt="" id="profile" onerror="ubah_foto()" style="width: 100%" data-user="foto">
					</div>
					<div class="col-8">
						<ul class="nopad user-data" >
							<li class="row">
								<div class="col-5 ">No Induk</div>
								<div class="col-7" data-user="id"><?php echo ": ".$user->username; ?></div>
							</li>
							<li class="row ">
								<div class="col-5 ">Nama Lengkap</div>
								<div class="col-7 "data-user="nama"><?php echo ": ".$user->nama; ?></div>
							</li>
							<li class="row ">
								<?php 
									$date = date_create($user->tgl_lahir);
								 ?>
								<div class="col-5 ">Tempat, Tgl Lahir</div>
								<div class="col-7 "data-user="ttl"><?php echo ": ".$user->tempat_lahir.", ".date_format($date,"d M Y"); ?></div>
							</li>
							<li class="row ">
								<div class="col-5 ">Level</div>
								<div class="col-7 "data-user="lvl">: <span class="<?php echo ($user->level=='a')? 'bg-success notice-text':'' ?>"> <?php echo ($user->level=='a')? 'Admin':'User' ?></span></div>
							</li>
							<li class="row ">
								<div class="col-5 ">Posisi / Kelas</div>
								<div class="col-7 "data-user="pos">: <?php echo ($kelas=='')? 'Guru':$kelas->kelas ; ?> </div>
							</li>
							<li class="row ">
								<div class="col-5 ">Status</div>
								<div class="col-7 "data-user="stat">: <span class="<?php echo ($user->status=='s')? 'bg-success':'bg-danger' ?> notice-text"><?php echo ($user->status=='s')? 'Sudah Voting':'Belum Voting' ?></span></div>
							</li>
						</ul>
					</div>
				
				</div>
			</div>
		</div>
<script>

  function ubah_foto() 
  {
     $('#profile').attr('src','<?php echo base_url('public/img/main/user.png') ?>');
  };

</script>