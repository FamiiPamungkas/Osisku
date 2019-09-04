<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="<?php echo base_url('public/css/login.css') ?>">
	<script src="<?php echo base_url('public/js/login.js') ?>"></script>
</head>
<body>
	<?php 
		if ($this->session->status=='logged') {
			redirect(base_url('User'));
			# code...
		}
	 ?>
	<section class="col-md-10" style="margin: 0 auto">
		<div class="center row form-panel">
			<div class="left col-md-6">
				<div class="icon">
					<img src="<?php echo base_url('public/img/main/osis.png') ?>" alt="">
				</div>
				<div class="judul">
					<h3>Osisku Voting System</h3>
				</div>
				<div class="desc">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio maxime magnam commodi, in quo? Natus quas, temporibus nostrum distinctio numquam quod odit itaque corporis, repudiandae et eius doloremque quo totam.</p>
				</div>
			</div>
			<div class="right col-md-6">
				<div class="form-login">
					<h3>Login</h3>
					<!-- <form action=""> -->
						<?php echo form_open('User/Login_to'); ?>
						<small>Username</small>
						<input type="text" placeholder="Nomor Induk" name="username">

						<small>Password</small>
						<input type="Password" name="password" placeholder="Password">

						<input type="submit" value="Login" style="color: #fff; background: gray">
						<!-- <a href="">Lupa Password ?</a> -->
						<div class="error_message">
							<?php if (isset($no_user)) { echo  '<p>'.$no_user.'</p>'; }?>
							<?php echo validation_errors(); ?>	

						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
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
	});
</script>
</html>