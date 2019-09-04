<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo base_url('public/css/dashboard.css') ?>">
	
</head>
<style>
	#absolute-page{
		position: absolute;
		width: 100%;
		height: 100%;
		z-index: 2;
		background: transparent;
	}
	#absolute-center-text{
		position: absolute;
		top:50%;
		left: 50%;
		height: 100%;
		width: 100%;
		z-index: 2;
	}
	#middle-content{
	}
</style>
<body>
	<?php 
		if ($this->session->status!='logged') {
			redirect(base_url('User/Login'));
		}else{
			
		}
	 ?>
	<main class="col-10 nopad" style="margin-left: auto;margin-right: auto;">
		<div  style="height: 100%;overflow: hidden; background: white;border-radius: 7px;">
			<div id="absolute-page" class="jumbotron text-center nopad nomar" style="overflow: hidden;">
				<div id="middle-content" style="">
					<h1 style="font-weight: bold;">Selamat datang di menu Voting !</h1>
					<?php if ($pemilihan==array()): ?>
						<?php 
							$mulai = '';
						?>
						<h4>Pemilihan ketua OSIS masih belum dimulai</h4>
						<span class="btn btn-success" id="">
							<a href="<?php echo base_url('User/Logout') ?>" style="color: #fff">	
								<span class="fa fa-sign-out-alt"></span><span> Logout</span> 
							</a>
						</span>
					<?php else: ?>
						<?php
							date_default_timezone_set('asia/jakarta'); 
							$mulai = strtotime($pemilihan->tgl_mulai);
							$akhir = strtotime($pemilihan->tgl_akhir);
							$now = strtotime('now');

						 ?>
						<?php if ($mulai < $now && $now < $akhir): ?>
							<h4>Mari kita lihat para Kandidat</h4>
							<span class="btn btn-success" id="lihat-kandidat">
								<span class="fa fa-eye"></span><span> Lihat Kandidat</span> 
							</span>
						<?php elseif ($now>$akhir): ?>
							<h4>Pemilihan ketua OSIS sudah berakhir</h4>
							<span class="btn btn-success" id="">
								<a href="<?php echo base_url('User/Logout') ?>" style="color: #fff">	
									<span class="fa fa-sign-out-alt"></span><span> Logout</span> 
								</a>
							</span>
						<?php elseif ($now<$mulai): ?>
						 	<input type="hidden" name="tgl_mulai" value="<?php echo date('Y/m/d',$mulai); ?>">
							<h4>Pemilihan ketua OSIS akan dilaksanakan pada :</h4>
							<h4><b><?php echo date('d M Y H:i',$mulai).' - '.date('d M Y H:i',$akhir); ?></b></h4>
							<!-- <span class="btn btn-success" id="lihat-kandidat">
								<a href="<?php echo base_url('User/Logout') ?>" style="color: #fff">	
									<span class="fa fa-sign-out-alt"></span><span> Logout</span> 
								</a>
							</span> -->
							<div class="row" style="width: 40%;margin: 0 auto">
								<div class="col-3 nopad">
									<div class="circle" style="background: rgba(13,92,99,0.8);border-radius:100px;width: 100px;height: 100px;margin: 0 auto ">
										<h1 id="cd-hari" style="color: #fff;line-height: 100px;margin: 0">100</h1>
									</div>
									<span style="text-align: center">Hari</span>
								</div>
								<div class="col-3 nopad">
									<div class="circle" style="background: rgba(13,92,99,0.8);border-radius:100px;width: 100px;height: 100px;margin: 0 auto ">
										<h1 id="cd-jam" style="color: #fff;line-height: 100px;margin: 0">100</h1>
									</div>
									<span style="text-align: center">Jam</span>
								</div>
								<div class="col-3 nopad">
									<div class="circle" style="background: rgba(13,92,99,0.8);border-radius:100px;width: 100px;height: 100px;margin: 0 auto ">
										<h1 id="cd-menit" style="color: #fff;line-height: 100px;margin: 0">100</h1>
									</div>
									<span>Menit</span>
								</div>
								<div class="col-3 nopad" style="padding: 0 !important">
									<div class="circle" style="background: rgba(13,92,99,0.8);border-radius:100px;width: 100px;height: 100px;margin: 0 auto ">
										<h1 id="cd-detik" style="color: #fff;line-height: 100px;margin: 0">100</h1>
									</div>
									<span>Detik</span>
								</div>
							</div>
						<?php endif ?>
					<?php endif ?>
				</div>

			</div>
			<div class="img-containter" style="position: absolute;width: 400px;overflow: hidden;height: 350px;bottom: 0;right: 0">
				<img src="<?php echo base_url('public/img/main/osis.png') ?>" style="width: 100%;opacity: 0.4" alt="">
			</div>
		</div>
		

	</main>

</body>
<script src="<?php echo base_url('public/js/countdown2.js') ?>"></script>
<script>
	$(document).ready(function () {
		resize_main();
		$(window).resize(function () {
			resize_main();
		});

		$('#lihat-kandidat').click(function () {
			// var formData = {'data':'ada'};
			$.ajax({
				type : 'post',
				url : 'User/lihat_kandidat',
				// data : formData,
				success : function (result) {
					$('#absolute-page').html(result);					
				}
			});
		});
		// <?php 
		// 	echo "var s = '".date('Y/m/d',$mulai)."';"; ;
		//  ?>
		// Countdown(s);

	});
	function resize_main() {
		var h_main = $(document).height() - $('header').height() - $('footer').outerHeight() - 40;
		$('main').height(h_main);
		$('main').css('margin-top',20);
		$('main').css('margin-bottom',20);

		var m_t = ( $('#absolute-page').height() - $('#middle-content').height() )/2;
		$('#middle-content').css('margin-top',m_t);
		// var m_t_f = ( $('#absolute-page').height() - 400 )/2;
		// $('#no_foto').css('margin-top',m_t_f);
		// var m_l = $('#absolute-center-text').width()/(-2);
		// $('#absolute-center-text').width();
		// $('#absolute-center-text').css('margin-left',m_l);
		// alert(h_main);
	}

</script>
</html>