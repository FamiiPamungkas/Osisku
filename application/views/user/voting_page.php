<style>
	.img-kandidat{
		height: 200px;
		overflow:hidden;	
	}

	.img-kandidat >img{
		width: 100%;
	}
	.calon-kandidat{
		cursor: pointer;
	}
</style>
<?php if ($this->Model_user->cek_voting($this->session->username)==true): ?>
	<div id="middle-content" style="">
		<h1 style="font-weight: bold;">Anda sudah melakukan Voting ! </h1>
		<h3>Terimakasih sudah berpartisipasi !</h3>
		<h4>Semoga kandidat yang terbaik yang menjadi pemenangnya</h4>
		<span class="btn btn-success" id="lihat-kandidat">
			<a href="<?php echo base_url('User/Logout') ?>" style="color: #fff">	
				<span class="fa fa-sign-out-alt"></span><span> Logout</span> 
			</a>
		</span>
	</div>
<?php else: ?>
	<div class="row" style="padding: 0 15px;overflow-y: scroll;height: 100%;" id="user-voting" data-user="<?php echo $this->session->username ?>">
		<div class="col-12">
				<h2 style="padding: 20px;margin: 0">Klik Kandidat pilihanmu !</h2>
		</div>
		<?php foreach ($kandidat as $k): ?>
			<?php foreach ($calon as $c): ?>
				<?php if ($c['nomor']==$k['no_calon']): ?>
					
				<div class="col-3">
					<div class="card calon-kandidat" data-id="<?php echo $k['no_calon'] ?>" style="border-radius: 10px;overflow:hidden; margin: 10px auto;width: 95%;border: 1px solid #91171F">
						<div class="card-body nopad " style="background: #91171F;color: #fff">
							<h1 style="text-align: center;"><?php echo $k['no_calon']; ?></h1>
						</div>
						<div class="img-kandidat" style="height: 250px">
							<img src="<?php echo base_url($c['foto']); ?>" class="" alt="" onerror="this.onerror=null;this.src='http://[::1]/Osisku/public/img/main/user.png';">
						</div>
						<div class="card-body">
							<h5 class="card-text"><b><?php echo $c['nama']; ?></b></h5>
							<?php foreach ($visi as $v): ?>
								<?php if ($v['id_vismis']==$k['id_vismis']): ?>
									<p class="card-text" style="text-align: left;">"<?php echo $v['visi']; ?>"</p>
								<?php endif ?>
							<?php endforeach ?>
						</div>
					</div>
				</div>

				<?php endif ?>
			<?php endforeach ?>
		<?php endforeach ?>
	</div>
<?php endif ?>
<script>
	$(document).ready(function () {
		// body...
		$('.calon-kandidat').click(function () {
			var fdata = {
				'id'		:$(this).attr('data-id'),
				'username'	:$('#user-voting').attr('data-user'),

			};
			// alert(id);
			var vote = confirm('Yakin pilih kandidat nomor '+$(this).attr('data-id')+' ?');
			if (vote == true) {
				$.ajax({
					type : 'post',
					url : 'User/vote',
					data : fdata,
					success : function (result) {
						$('#absolute-page').html(result);					
					}
				});
			}else{
				// alert('kasndas');
			}
		});

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