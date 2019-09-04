	<header class="w3-container ajax-result" data-ajax='kandidat_no' style="padding-top:22px">
      <h5><b><i class="fa fa-users"></i> Nomor Kandidat</b></h5>
    </header>

    <style>
    	.card-button-right{
    		position: absolute;
    		top: 13px;
    		right: 10px;
    	}
    
		.kandidat-calon{
			width: 230px;
			overflow: hidden;
			margin-top: 10px;
			margin-left: 10px;
			height: 320px;
		}
		.img-container{
			height: 230px;
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
		.lingkaran{
			border-radius: 30px;
		}

		.error-messages > p:last-child{
			margin: 0;
		}
		.img-kandidat{
			height: 200px;
			overflow:hidden;	
		}

		.img-kandidat >img{
			width: 100%;
		}
		.foto-pasangan >div > img{
			position: absolute;
			top:50%;
			left: 50%;
			margin: -50%;
		}
		.foto-pasangan >div{
			float: left;
			height: 200px;
		}
		.kandidat-act > ul > li:hover{
			background: gray;
			cursor: pointer;
			color: #fff;
		}
		.kandidat-act > ul > li{
			padding: 6px 20px;

		}
		.kandidat-act > ul{
			list-style: none;
			margin: 0;
			padding: 0; 
			background: rgba(255,255,255,0.7);

		}
		.kandidat-act{
			display: none;
			position: absolute;
		}
    </style>

	<main class="container" id="container">
	<hr>
		<div class="card" style="width: 40%">
			<?php if ($jml_kandidat<1): ?>
				
				<?php if (isset($tipe)): ?>
					
					<div class="card-body bg-info">
						<label for="" class="nomar"><b>Tipe Kandidat : <?php echo $tipe['nama']; ?></b></label>	
					</div>
				
				<?php else: ?>
				
					<div class="card-body">
						<label for="" class="">Pilih Tipe Kandidat :</label>
						<form action="" id="kandidat-tipe">
							<select name="tipe" id="" class="form-control" style="margin-bottom: 10px;">
								<!-- <option value="">---- Pilih Tipe ----</option>? -->
								<option value="0">Kandidat Tunggal</option>
								<!-- <option value="1">Kandidat Pasangan</option> -->
							</select>
							<input type="submit" class="btn btn-success">
						</form>
					</div>

				<?php endif ?>

			<?php else: ?>
				<?php 
					foreach ($kandidat as $tp_k) {
						$type_k = ($tp_k['tipe']==1)? 'Kandidat Pasangan':'Kandidat Tunggal';
					}
				 ?>
				<div class="card-body bg-info">
					<label for="" class="nomar"><b>Tipe Kandidat : <?php echo $type_k; ?></b></label>	
				</div>

			<?php endif ?>

		</div>

		<hr>
		<?php if ($jml_kandidat>0 || isset($tipe)): ?>
			
		<div class="card">
			<div class="card-body bg-info text-white">
				<h5 class="card-title nomar">List Kandidat</h5>
				<?php if (!isset($pemilihan)): ?>
						<?php if ($jml_kandidat<6): ?>
							<span class="btn btn-success card-button-right" id="tambah-kandidat" 
								data-tipe=" <?php echo $tipe['tipe'] ?>">
								<span class="fa fa-plus"></span>
							</span>	
						<?php endif ?>
				<?php else: ?>	
					<?php if ($pemilihan==array() || (strtotime('now')<=strtotime($pemilihan->tgl_mulai))): ?>
					
						<?php if ($jml_kandidat<6): ?>
							<span class="btn btn-success card-button-right" id="tambah-kandidat" 
								data-tipe=" <?php echo $tipe['tipe'] ?>">
								<span class="fa fa-plus"></span>
							</span>	
						<?php endif ?>

					<?php endif ?>
				<?php endif ?>

			</div>
			<div class="card-body row">
				
				<?php if ($jml_kandidat>0): ?>
					<?php if ($tipe['tipe']<>0): ?>
						<!-- pasangan kandidat -->
					<div class="col-4">
						<div class="card" style="border-radius: 10px;overflow:hidden;">
							<div class="card-body nopad bg-primary">
								<h1 style="text-align: center;"></h1>
							</div>
							<div class="foto-pasangan">
								<div class="col-6 nopad">
									<img src="<?php echo base_url('public/img/main/user.png'); ?>" class="card-img-top" alt="">
									
								</div>
								<div class="col-6 nopad">
									<img src="<?php echo base_url('public/img/main/user.png'); ?>" class="card-img-top" alt="">
									
								</div>
							</div>
							<div class="card-body">
								<h6 class="card-text">Fahmi Pamungkas &	</h6>
								<h6 class="card-text">Suherdianto</h6>
								<p class="card-text" style="">"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium eligendi."</p>
							</div>
						</div>
					</div>
					<?php else: ?>
						<?php foreach ($kandidat as $k): ?>
							<?php foreach ($calon as $c): ?>
								<?php if ($c['nomor']==$k['no_calon']): ?>
									
							<div class="col-3" style="margin-top: 10px;">
								<div class="card" style="border-radius: 10px;overflow:hidden;">
									<div class="card-body nopad " style="background: #91171F;color: #fff">
										<h1 style="text-align: center;"><?php echo $k['no_calon']; ?></h1>
				
										<?php if ($pemilihan==array() || (strtotime('now')<=strtotime($pemilihan->tgl_mulai))): ?>

											<span class="btn act-button" data-no="<?php echo $k['no_calon'] ?>" style="position: absolute;top:8px;right: 8px;color: #fff">
												<span class="fa fa-bars"></span>
											</span>
										
										<?php endif ?>

									</div>
									<div class="img-kandidat" style="height: 250px">
										<div class="col-12 nopad kandidat-act" data-no="<?php echo $k['no_calon'] ?>">
											<ul style="">
												<li style="" class="edit-kandidat" data-id="<?php echo $k['id_kandidat']; ?>"><b>Edit</b></li>
												<li style="" class="hapus-kandidat" data-id="<?php echo $k['id_kandidat']; ?>"><b>Hapus</b></li>
											</ul>
										</div>
										<img src="<?php echo base_url($c['foto']); ?>" class="" alt="" onerror="this.onerror=null;this.src='<?php echo base_url('public/img/main/user.png'); ?>';">
										
									</div>
									<div class="card-body">
										<h6 class="card-text"><?php echo $c['nama']; ?></h6>
										<?php foreach ($visi_misi as $v_m): ?>
											<?php if ($v_m['id_vismis']==$k['id_vismis']): ?>
												<p class="card-text" style="text-align: left;">"<?php echo $v_m['visi'];?>"</p>
												<?php break ?>
											<?php endif ?>
										<?php endforeach ?>
									</div>
								</div>
							</div>

								<?php endif ?>
							<?php endforeach ?>
						<?php endforeach ?>
					<?php endif ?>
				<?php endif ?>

				

			</div>
		</div>

		<hr>
					<!-- <?php print_r($visi_misi) ?> -->
		<?php if (isset($tambah)): ?>
			
		<div class="card">
			<div class="card-body bg-info text-white">
				<h5 class="card-title nomar">Edit kandidat</h5>
			</div>
			<div class="card-body row">
				<div class="col-6">
					<form action="" id="form-kandidat">
						<input type="hidden" name="tipe" value="<?php echo $tipe['tipe'] ?>">
						<input type="hidden" name="mode" value="<?php echo (isset($form))? $form['mode']:''; ?>">
						
						
						<label for="">Nomor Kandidat :</label>
							<select name="no_kandidat" id="no_kandidat" class="form-control"
							<?php if(isset($form)){ echo ($form['mode']=='edit')? 'disabled':'';} ?>>

								<?php
									if ($tipe['tipe']==0) {
										$banyak = $jml_calon;
									}else{
										$banyak = round($jml_calon/2);
									};
									
									for ($i=0; $i < $banyak; $i++) { 
									# code...
										$no_selec = (($i+1)==$form['no_kandidat'])? 'selected':'';
										echo "<option value='".($i+1)."' ".$no_selec.">".($i+1)."</option>"; 
									}; 
								?>
								
							</select>
						<br>
						<label for="">Pilih Calon :</label>
						<select name="calon1" id="calon1" data-no="1" class="form-control" onchange="preview_calon(this)"<?php if(isset($form)){ echo ($form['mode']=='edit')? 'disabled':'';} ?>>
							<?php echo $text_pilih = ($tipe['tipe']==0)? 'Pilih Calon':'Pilih Calon Pertama' ;?>
							<option value="">----- <?php echo $text_pilih ?> -----</option>
							<?php foreach ($data_calon as $d_c): ?>
								<option value="<?php echo $d_c['username'].";".$d_c['foto'].";".$d_c['nama']; ?>"
								<?php
									if (isset($form)) { 
										$u_name2 = explode(';',$form['calon1']);
										echo ($d_c['username']== $u_name2[0])? 'selected':'';
									}; 
								?>
									><?php echo $d_c['nama'] ?></option>
							<?php endforeach ?>
						</select>
						<br>
						<?php if ($tipe['tipe']==1): ?>
							
							<select name="calon2" id="calon2" data-no="2" class="form-control" onchange="preview_calon(this)">
								<option value="">----- Pilih Calon Kedua -----</option>
								<?php foreach ($data_calon as $d_c): ?>
									<option value="<?php echo $d_c['username'].";".$d_c['foto'].";".$d_c['nama']; ?>"

									<?php
										if (isset($form)) { 
											$u_name2 = explode(';',$form['calon2']);
											echo ($d_c['username']== $u_name2[0])? 'selected':'';
										}; 
									?>>
										<?php echo $d_c['nama']; ?>
									</option>

								<?php endforeach ?>
							</select>
							<br>

						<?php endif ?>
						<label for="">Visi Kandidat :</label>
						<br>
						<input name="visi" type="text" placeholder="Visi Kandidat" class="form-control" value="<?php echo (isset($form))? $form['visi']:''; ?>">
						<br>
						<label for="">Misi Kandidat :</label>
						<br>
						<input name="misi1" type="text" placeholder="Misi Kandidat" class="form-control" value="<?php echo (isset($form))? $form['misi1']:''; ?>">
						<br>
						<input name="misi2" type="text" placeholder="Misi Kandidat" class="form-control" value="<?php echo (isset($form))? $form['misi2']:''; ?>">
						<br>
						<input name="misi3" type="text" placeholder="Misi Kandidat" class="form-control" value="<?php echo (isset($form))? $form['misi3']:''; ?>">
						<br>
						<input name="misi4" type="text" placeholder="Misi Kandidat" class="form-control" value="<?php echo (isset($form))? $form['misi4']:''; ?>" >
						<br>
						<input name="misi5" type="text" placeholder="Misi Kandidat" class="form-control" value="<?php echo (isset($form))? $form['misi5']:''; ?>">
						<br>
						<input type="submit" class="btn btn-success">
					</form>
					
				</div>
				<div class="col-6">
					<div class="col-12" style="height: 350px;display: block;">
						<?php if ($tipe['tipe']==1): ?>
						<div class="card kandidat-calon" data-calon="" style="float: right; width: 45%">

							<div class="img-container">
								<img src="<?php if(isset($form)){ $cal_in2=explode(';',$form['calon2']);echo $cal_in2[1];} ?>" class="card-img-top kandidat-img" id="preview-calon2" alt="" onerror="this.onerror=null;this.src='http://[::1]/Osisku/public/img/main/user.png';">
							</div>
							<div class="card-body bg-primary text-white">
								<h5 class="card-title" id="nama-calon2"><?php if (isset($form)) {echo $cal_in2[2];}else{echo "----------";} ?></h5>
							</div>

						</div>
						<?php endif ?>
							
						<div class="card kandidat-calon" data-calon="" style="float: right; width: 45%">

							<div class="img-container">
								<!-- <img src="" class="card-img-top kandidat-img" id="preview-calon1" alt="" onerror="this.onerror=null;this.src='http://[::1]/Osisku/public/img/main/user.png';"> -->
								<img src="<?php if(isset($form)){ $cal_in1=explode(';',$form['calon1']);echo $cal_in1[1];} ?>" class="card-img-top kandidat-img" id="preview-calon1" alt="" onerror="this.onerror=null;this.src='http://[::1]/Osisku/public/img/main/user.png';">
							</div>
							<div class="card-body bg-primary text-white">
								<!-- <h5 class="card-title" id="nama-calon1">----------</h5> -->
								<h5 class="card-title" id="nama-calon1"><?php if (isset($form)) {echo $cal_in1[2];}else{echo "----------";} ?></h5>
							</div>

						</div>
					</div>
					<div class="col-12" style="display: block;">
						<?php if (validation_errors()): ?>
						
							<div class="card alert alert-danger">
								<div class="error-messages">
									<?php echo validation_errors(); ?>
								</div>
							</div>

						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
		<?php endif ?>

		<?php endif ?>
	</main>
<script>
	$(document).ready(function () {
		$('#kandidat-tipe').on('submit',function () {
			$.ajax({
				type : 'post',
				url  : 'Admin/kandidat_tipe',
				data : new FormData(this),
				contentType: false,
				cache: false,
				processData: false,
				success : function (result) {
					$('#ajax-container').html(result);
				}
			});
			return false;
		});

		$('#tambah-kandidat').click(function () {
			var Fdata =  {'tipe': $(this).attr('data-tipe')};
			$.ajax({
				type : 'post',
				url  : 'Admin/kandidat_tambah',
				data :  Fdata,
				success : function (result) {
					$('#ajax-container').html(result);
				}
			});
		});	

		$('#form-kandidat').on('submit',function () {
			$('#no_kandidat').prop('disabled',false);
			$('#calon1').prop('disabled',false);
			$('#calon2').prop('disabled',false);
			$.ajax({
				type : 'post',
				url  : 'Admin/kandidat_simpan',
				data : new FormData(this),
				contentType : false,
				cache : false,
				processData : false,
				success : function (result) {
					// body...
					$('#ajax-container').html(result);
				}
			});
			return false;

		});

		$('.act-button').click(function () {
			// body...
			// alert('oke gan');
			var nomor = $(this).attr('data-no');
			if ($('.kandidat-act[data-no="'+nomor+'"]').is(':visible')) {

				$('.kandidat-act[data-no="'+nomor+'"]').hide();
			}else{
				$('.kandidat-act[data-no="'+nomor+'"]').show();
				
			}
			// alert("[class='kandidat-act'][data-no='"+nomor+"']");
		});

		$('.hapus-kandidat').click(function () {
			var id = {'id' : $(this).attr('data-id') };
			$.ajax({
				type : 'post',
				url : 'Admin/kandidat_hapus',
				data : id,
				success : function (result) {
					// body...
					$('#ajax-container').html(result);
				}
			});

		});

		$('.edit-kandidat').click(function () {
			var id = { 'id' : $(this).attr('data-id') };
			$.ajax({
				type : 'post',
				url : 'Admin/kandidat_tambah/null/'+$(this).attr('data-id'),
				data : id,
				success : function (result) {
					$('#ajax-container').html(result);
				}
			});

		});

	});

	function preview_calon(ini) {

		var array = ini.value.split(';');
		// [0] = id
		// [1] = foto
		// [2] = nama
		var no = $(ini).attr('data-no');
		 <?php echo "var img_def ='".base_url("public/img/main/user.png")."'"; ?>;
		if (array[1]=='') {
			var foto = img_def;
		}else{
			var foto = array[1];
		};

		$('#preview-calon'+no).attr('src',foto);
		$('#preview-calon'+no).attr('alt',array[0]);
		$('#nama-calon'+no).html(array[2]);
		cek_id_kandidat(no);
	};

	function cek_id_kandidat(no) {

		
		if ($('#preview-calon'+no).attr('alt')!='') {
		}
			// alert('#preview-calon'+no);
			if ($('#preview-calon1').attr('alt')==$('#preview-calon2').attr('alt')) {
		 		<?php echo "var img_def ='".base_url("public/img/main/user.png")."'"; ?>;
				// alert("[name='calon"+no+"']");
				// alert($("[name='calon"+no+"']").val());
				$("[name='calon"+no+"'] option[value='']").attr('selected','selected');
				alert('Calon kandidat Harus Berbeda !');
				
				$('#preview-calon'+no).attr('src',img_def);
				$('#preview-calon'+no).attr('alt','');
				$('#nama-calon'+no).html('----------');
			}
		}

</script>
