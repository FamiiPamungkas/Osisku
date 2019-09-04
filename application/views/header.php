<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Selamat Datang di Osisku</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  	<link rel="stylesheet" href="<?php echo base_url('framework/css/bootstrap.min.css'); ?>">
  	<link rel="stylesheet" href="<?php echo base_url('public/css/welcome.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/css/header.css') ?>">

  	<script src="<?php echo base_url('framework/js/jquery-3.3.1.min.js'); ?>"></script>
  	<script src="<?php echo base_url('framework/js/fontawesome-all.min.js'); ?>"></script>
  	<script src="<?php echo base_url('framework/js/bootstrap.min.js'); ?>"></script>
 	<script src="<?php echo base_url('public/js/countdown.js') ?>"></script>
	<script src="<?php echo base_url('public/js/header.js') ?>"></script>
	
</head>
<body>
	<header>
		<div class="center row col-md-10 nopad">
			<div class="judul col-md-4 nomar nopad">
				<div class="mobile-nav">
					<span class="fa fa-list fa-2x" id="mobile-nav-toggle" data-fa-transform="shrink-5" style="color: #fff;margin: 19px" ></span>
					<input type="checkbox" class="" id="mobile-nav-check">
				</div>
				<h3 class="nomar"><a href="<?php echo site_url()?>">Osisku Voting System</a></h3>
			</div>
			<div class=" nav-absolute col-md-12" >
				<ul class="nomar nopad">
					<li><a href="<?php 	echo site_url() ?>">Home</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">News</a></li>
					<li><a href="<?php echo site_url('User/Login')?>" class="btn btn-success">Login</a></li>
				</ul>	
			</div>
			<div class="nav col-md-8 nopad">
				<ul class="nomar nopad">
					
					<?php if ($this->session->status!='logged'): ?>
						<li><a href="<?php echo site_url('User/Login')?>" class="btn btn-success">Login</a></li>
					<?php else: ?>	
						<li id="profile">
							<div class="profile-pic">
								<div class="image">
									<img src="<?php echo base_url($this->session->foto); ?>" alt="" onerror="this.onerror=null;this.src='http://[::1]/Osisku/public/img/main/user.png';">
								</div>
							</div>
							<div class="profile-name">
								<?php $username = $this->session->username ?>
								<h6 class="nopad nomar">Hai <?php echo ucwords($this->Model_user->get_user($username)->nama); ?></h6>
							</div>
							<ul class="profile-dropdown">
								<li><a href="<?php echo base_url('User/Logout') ?>">Logout</a></li>
							</ul>
						</li>
						<?php if ($this->session->level == 'a'): ?>
							<li><a href="<?php echo base_url('User'); ?>">Voting</a></li>
							<li><a href="<?php echo base_url('Admin'); ?>"">Dashboard</a></li>
						<?php else: ?>
							<li><a href="<?php echo base_url('User'); ?>"">Voting</a></li>
						<?php endif ?>
					<?php endif ?>
				</ul>
			</div>
		</div>
	</header>
