<style>
	#kandidat-carousel{
		width: 100%;
		height: 100%;
		overflow: hidden;
	}
	.carousel-item {
		height: 100% !important;
		background: <?php echo 'url('.base_url('public/img/main/background.jpg').')' ?>;
	}
	.img-container{
		/*background: white;*/
		overflow: hidden;
		border-radius: 5px;
		max-height: 320px;
	}
	.img-container > img{
		border-radius: 5px;
		width: 100%;
		/*padding: 10px;*/
	}
	::-webkit-scrollbar {
	display: none;
	}
	.borderless td, .borderless th {
    border: none;
	}	
	.carousel-indicators > li.active{
		background: #23B5D3 !important;

	}
	.carousel-indicators > li{
		background: rgba(35,181,211,0.5); !important;
	}
	
	.carousel-control-prev,.carousel-control-next {
		color: #23B5D3 !important;
	}
	.carousel-indicators{
		bottom: 0px;
	}

</style>
<div id="kandidat-carousel" class="carousel slide" data-ride="carousel" data-interval="false">
  <!-- Indicators -->
  <ul class="carousel-indicators">
  	<?php $no = 0; ?>
  	<?php foreach ($kandidat as $kn): ?>
  		<?php $no = $no+1; ?>
    	<li data-target="#kandidat-carousel" data-slide-to="<?php echo ($no-1) ?>" class="<?php echo ($no==1)? 'active':''; ?>"></li>
  	<?php endforeach ?>
    	<li data-target="#kandidat-carousel" data-slide-to="<?php echo ($no) ?>" class=""></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner" style="height: 100%;">
  	<?php $n = 0; ?>
  	<?php foreach ($kandidat as $k): ?>
  		<?php $n = $n+1 ?>
  		<?php foreach ($calon as $d_c): ?>
  			<?php if ($d_c['nomor']==$k['no_calon']): ?>
  					
			    <div class="carousel-item <?php echo ($n==1)? 'active':'';?>">
			    	<div class="row" style="width: 70%;margin: 0 auto; height: 100%">
			    		<div class="col-5 no_foto" id="">
			    			<h1 style="color: #fff"><b>No. <?php echo $k['no_calon']; ?></b></h1>
			    			<div class="img-container">
			    				<img src="<?php echo base_url($d_c['foto']) ?>" alt="" onerror="this.onerror=null;this.src='<?php echo base_url('public/img/main/user.png'); ?>';">
			    			</div>
			    		</div>
			    		<div class="col-7">
			    			<div class="data-kandidat" id="" style="background: #fff; overflow-y: scroll;border-radius: 7px;max-height: 400px;">
			    				<table class="table table-sm borderless" style="text-align: left;margin: 0">
			    					<tr style="background: #A99985">
										<td colspan="2" style="text-align: center;"><h5>DATA KANDIDAT</h5></td>
			    					</tr>
			    					<tr style="background: #F5F1ED">
										<td width="20%"><h6>NIS</h6></td>
										<td width="80%"><h6>: <?php echo $d_c['username'] ?></h6></td>
			    					</tr>
			    					<tr style="background: #F5F1ED">
										<td><h6>Nama</h6></td>
										<td><h6>: <?php echo $d_c['nama'] ?></h6></td>
			    					</tr>
			    					<?php foreach ($kelas as $k_l): ?>
			    						<?php if ($k_l['nis']==$d_c['username']): ?>
					    					<tr style="background: #F5F1ED">
												<td><h6>Kelas</h6></td>
												<td><h6>: <?php echo $k_l['kelas']; ?></h6></td>
					    					</tr>
			    						<?php endif ?>
			    					<?php endforeach ?>
			    					<tr style="background: #A99985">
										<td colspan="2" style="text-align: center;"><h5>VISI</h5></td>
			    					</tr>
									<?php foreach ($visi as $v): ?>
										<?php if ($v['id_vismis']==$k['id_vismis']): ?>
					    					<tr style="background: #F5F1ED">
												<td colspan="2" style="text-align: center;">
													<h6>"<?php echo $v['visi']; ?>"</h6>
												</td>
					    					</tr>
										<?php endif ?>
									<?php endforeach ?>

			    					<tr style="background: #A99985">
										<td colspan="2" style="text-align: center;"><h5>MISI</h5></td>
			    					</tr>
			    					<?php foreach ($visi_misi as $v_m): ?>
			    						<?php if ($v_m['id_vismis']==$k['id_vismis']): ?>
					    					<tr style="background: #F5F1ED">
												<td colspan="2" style="text-align:left;">
													<h6><?php echo $v_m['misi']; ?></h6>
												</td>
					    					</tr>
			    						<?php endif ?>
			    					<?php endforeach ?>
			    					
			    				</table>
									
			    			</div>
			    		</div>
			    	</div>
			      <!-- <img src="<?php echo base_url('public/img/main/background.jpg') ?>" alt="Los Angeles" style="width: 100%;height: 500px;"> -->
			    </div>

  			<?php endif ?>	
  		<?php endforeach ?>
  	<?php endforeach ?>
  	<div class="carousel-item">
		<div class="" style="width: 70%;margin: 0 auto; height: 100%">
  			<div id="absolute-page" class="jumbotron text-center nopad nomar" style="overflow: hidden;left: 0">
				<div id="middle-content" style="" style="color: #fff">
					<h1 style="font-weight: bold; color: #fff">Sudah siap untuk memilih ?</h1>
					<h4 style="color: #fff">Klik lanjutkan untuk mulai memilih kandidat</h4>
					<span class="btn btn-success" id="voting">
						<span> Lanjutkan Voting</span> <span class="fa fa-arrow-alt-circle-right"></span>
					</span>
				</div>

			</div>
  		</div>
  	</div>

  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#kandidat-carousel" data-slide="prev">
    <span class="fa fa-caret-left fa-2x"></span>
  </a>
  <a class="carousel-control-next" href="#kandidat-carousel" data-slide="next">
    <span class="fa fa-caret-right fa-2x"></span>
  </a>
</div>
<script>
	$(document).ready(function () {
		// alert('Okee');
		
		resize_data();
		$(window).resize(function () {
			// body...
			resize_data();
		});

		$('#voting').click(function () {
			// var formData = {'data':'ada'};
			$.ajax({
				type : 'post',
				url : 'User/voting_page',
				// data : formData,
				success : function (result) {
					$('#absolute-page').html(result);					
				}
			});
		});

	});
	function resize_data() {
		var m_t = ( $('#absolute-page').height() - 130 )/2;
		var m_t_f = ( $('#absolute-page').height() - 400 )/2;
		var m_t_d = ( $('#absolute-page').height() - 400 )/2;
		// alert($('#absolute-page').height());
		// alert($('#middle-content').height());
		// alert(m_t);
		$('#middle-content').css('margin-top',m_t);	
		$('.no_foto').css('margin-top',m_t_f);
		$('.data-kandidat').css('margin-top',m_t_d);
	}
</script>