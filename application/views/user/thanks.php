<div id="middle-content" style="">
	<h1 style="font-weight: bold;">Terimakasih sudah berpartisipasi !</h1>
	<h4>Semoga kandidat yang terbaik yang menjadi pemenangnya</h4>
	<span class="btn btn-success" id="lihat-kandidat">
		<a href="<?php echo base_url('User/Logout') ?>" style="color: #fff">	
			<span class="fa fa-sign-out-alt"></span><span> Logout</span> 
		</a>
	</span>
</div>
<script>
	$(document).ready(function () {

		thanks_position();
		$(window).resize(function () {
			thanks_position();
		});

	});
	function thanks_position() {
		// body...
		var m_t = ( $('#absolute-page').height() - $('#middle-content').height() )/2;
		$('#middle-content').css('margin-top',m_t);
	}
</script>