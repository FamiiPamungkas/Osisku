        <div class=" bg-primary row nopad nomar">
          <div class="col-6  card-body">
            <h5 class="nomar text-white" style="">Perolehan sampai saat ini</h5>
          </div>
          <div class="col-6 " style="padding-right: 0">
            <div class="" style="float: right;background: red">
              <h3 style="margin: 0;line-height: 60px;color: #fff;padding:0 10px"> <?php echo number_format($jml_voting/$jml_user*100,2)."%"; ?></h3>
            </div>
            <div style="float: right;">
              <h5 style="text-align: right;line-height: 58px; padding: 0 10px;font-weight: bold;" class="nomar"><small>Total Suara :</small></h5>
            </div>
          </div>
        </div>
        <div id="voting-result">
          
        <?php foreach ($kandidat as $k): ?>
          <?php foreach ($calon as $c): ?>
            <?php if ($c['nomor']==$k['no_calon']): ?>
              
              <div  class="card-body row nopad nomar" style="border-bottom: 1px #ddd solid">
                <div class="col-2">
                  <div class="img-container">
                    <img src="<?php echo base_url($c['foto']) ?>" alt="" onerror="this.onerror=null;this.src='<?php echo base_url('public/img/main/user.png'); ?>';">
                  </div>
                </div>
                <div class="col-10" style="padding: 20px;">
                  <div class="nama-kandidat">
                    <h5><?php echo $k['no_calon']; ?>. <?php echo $c['nama']; ?></h5>
                  </div>
                  <div class="total-bar" style="">
                    <?php 
                      if ($jml_voting==0) {
                        $persen = number_format(0,2);
                      }else{
                        $persen = $this->Kandidat->jml_voting_kandidat($k['no_calon'])/$jml_voting*100;
                      }
                     ?>
                    <div class="gauge-bar bg-primary" style="width: <?php echo round($persen,2).'%'; ?>"></div>
                    <h5 class="persen-text" data-percent=""> <?php echo round($persen,2); ?> %</h5>
                    <h5 class="jml-text" data-percent=""> <?php echo $this->Kandidat->jml_voting_kandidat($k['no_calon']); ?>  Suara</h5>

                  </div>
                </div>
              </div>

            <?php endif ?>
          <?php endforeach ?>
        <?php endforeach ?>

        </div>