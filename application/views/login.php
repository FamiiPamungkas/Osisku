<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="<?php echo base_url('public/css/login.css') ?>">
	<script src="<?php echo base_url('public/js/login.js') ?>"></script>
	<title>Osisku Login Page</title>
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

	.img-container img{
		width: 100%;
	}
	.img-container{
		margin: 0 auto;
		width: 70px;
		
	}
	.form{
		margin: 0 auto;
	}
	.form small{
		/*text-align: left;*/
		float: left;
	}
	footer{
		position: relative !important;
	}
	.errors{
		margin-top: 10px !important;
	}
	.errors > p{
		margin: 0;
	}
</style>
<body>
	<?php 
		if ($this->session->status=='logged') {
			redirect(base_url('User'));
			# code...
		}
	 ?>
	<main class="col-10 nopad" style="margin-left: auto;margin-right: auto;">
		<div  style="height: 100%;overflow: hidden; background: white;border-radius: 7px;">
			<div id="absolute-page" class="jumbotron text-center nopad nomar" style="overflow: hidden;">
				<div id="middle-content" style="">
					<div class="img-container">
						<img src="<?php echo base_url('public/img/main/osis.png') ?>" alt="">
					</div>
					<h1 style="">Osisku Login Page</h1>
					<div class="col-12 col-md-4 form">
						<?php echo form_open('User/Login_to'); ?>
							<small>Username</small>
							<input class="form-control" type="text" placeholder="Nomor Induk" name="username">
							<small style="margin-top: 10px;">Password</small>
							<input class="form-control" type="Password" name="password" placeholder="Password">

							<?php if (isset($no_user)): ?>
								<div class="alert alert-danger errors nopad nomar">
									<p><?php echo $no_user; ?></p>
								</div>
							<?php elseif (validation_errors()): ?>
								<div class="alert alert-danger errors nopad nomar">
									<?php echo validation_errors(); ?>
								</div>
							<?php endif ?>

							<input type="submit" class="form-control btn btn-success" value="Login" style="margin-top: 10px">
							<!-- <a href="">Lupa Password ?</a> -->
						</form>
					</div>
				</div>

			</div>
			<div class="img-containter" style="position: absolute;width: 400px;overflow: hidden;height: 350px;bottom: 0;right: 0">
				<img src="<?php echo base_url('public/img/main/osis.png') ?>" style="width: 100%;opacity: 0.4" alt="">
			</div>
		</div>
	</main>
	<?php if (isset($info)): ?>
						
	<div class="ab-layer">
		<div class="col-6" style="margin: 0 auto;">
			<div class="card ">
				<div class="card-header bg-info">
					<h4 style="margin: 0; color: #fff"><?php echo $info['title']; ?></h4>
					<span class="fa fa-times fa-2x" id="close-info"></span>	
				</div>
				<div class="card-body">
					<h5><?php echo $info['message']; ?></h5>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>

</body>
<script>
	$(document).ready(function () {
		// body...
		$('#close-info').click(function () {
			// body...
			$('.ab-layer').hide();
		});
		$('.ab-layer').click(function () {
			$('.ab-layer').hide();
			// body...
			
		});

		$('input').focus(function () {
			// delay(200);
			$('.errors').fadeOut();
			setTimeout(function () {
				resize_main();
			},500);
		});


		resize_main();
		$(window).resize(function () {
			resize_main();
		});

	});

	function resize_main() {
	var h_main = $(document).height() - $('header').height() - $('footer').outerHeight() - 40;
	$('main').height(h_main);
	$('main').css('margin-top',20);
	$('main').css('margin-bottom',20);
		var ab = $('#absolute-page').height();
		var md = $('#middle-content').height();
		// alert('middle :'+$('#middle-content').height());
		if (md>ab) {
			$('#middle-content').css('height',500);
			// alert('okee');

		}else{
			// alert('ab :'+ab+' md : '+md);
			var m_t = ( $('#absolute-page').height() - $('#middle-content').height() - 30 )/2;
			$('#middle-content').css('margin-top',m_t);

		}
	}

</script>
</html>