
<head>
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo base_url('public/css/dashboard.css') ?>">
	<script src="<?php echo base_url('public/js/dashboard.js') ?>"></script>
</head>

<body>
	<?php 
		if ($this->session->status!='logged') {
			redirect(base_url('User/Login'));
		}elseif ($this->session->level=='us' || $this->session->level=='ug') {
			redirect(base_url('User'));
			# code...
		}
	 ?>
	 <div class="col-md-12 row nopad nomar utama">
	 	<aside class="col-md-2 side-menu nopad container">
	 		<div class="panel-group" id="accordion">
	 			<div class="panel panel-default">
	 				<div class="panel-heading">
	 					<a href="#collapse1" data-parent="#accordion" data-toggle="collapse" class="panel-title">
							<i class="fa fa-user fa-lg"></i>
							<span>Kelola User</span>	 						
	 					</a>
	 				</div>
	 				<div id="collapse1" class="panel-collapse collapse in">
	 					<ul class="nopad nomar">
	 						<li id="user_list">
	 							<a href="#">
	 								<i class="fa fa-user fa-lg"></i>
	 								<span>Lihat User</span>
	 							</a>
	 						</li>
							<li id="import_user" data="Import_user">
	 							<a href="#">
	 								<i class="fa fa-file-excel fa-lg"></i>
	 								<span>Import Data User</span>
	 							</a>
	 						</li>
	 					</ul>
	 				</div>
	 			</div>
	 		</div>
	 	</aside>
	 	<section class="col-md-10 nopad" id="dashboard">	
	 	</section>
	 </div>
	
</body>