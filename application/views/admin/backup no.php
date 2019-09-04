````					<!-- pasangan tunggal -->
						<?php foreach ($kandidat as $k): ?>
							<?php foreach ($calon as $c): ?>
								<?php if ($c['nomor']==$k['no_calon']): ?>
									<?php foreach ($data_kandidat as $d_k): ?>
										<?php if ($c['nis']==$d_k['username']): ?>

							<div class="col-3">
								<div class="card" style="border-radius: 10px;overflow:hidden;">
									<div class="card-body nopad bg-primary">
										<h1 style="text-align: center;"><?php echo $k['no_calon']; ?></h1>
									</div>
									<div class="img-kandidat" style="height: 250px">
										<img src="<?php echo base_url($d_k['foto']); ?>" class="card-img-top" alt="" >
										
									</div>
									<div class="card-body">
										<h6 class="card-text"><?php echo $d_k['nama']; ?></h6>
										<h6 class="card-text">Suherdianto</h6>
										<p class="card-text" style="text-align: left;">"<?php echo $k[]; ?>"</p>
									</div>
								</div>
							</div>

											
										<?php endif ?>
									<?php endforeach ?>
								<?php endif ?>
							<?php endforeach ?>
						<?php endforeach ?>
				