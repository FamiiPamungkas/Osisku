    <!-- Header -->
    <header class="w3-container ajax-result" data-ajax='overview' style="padding-top:22px">
      <h5><b><i class="fa fa-tachometer-alt"></i> My Dashboard</b></h5>
    </header>
    <link rel="stylesheet" href="<?php echo base_url('public/css/overview.css'); ?>">
    <div class="w3-row-padding w3-margin-bottom">
      <div class="w3-quarter">
        <div class="w3-container w3-teal w3-text-white w3-padding-16 overview">
          <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3><?php echo $jml_user ?></h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Banyak User</h4>
        </div>
      </div>
      <div class="w3-quarter">
        <div class="w3-container w3-blue w3-padding-16 overview">
          <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3 id="jml_voting"><?php echo $jml_voting ?></h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Telah Memilih</h4>
        </div>
      </div>
      <div class="w3-quarter">
        <div class="w3-container w3-red w3-padding-16 overview">
          <div class="w3-left"><i class="fa fa-award w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3><?php echo $jml_kandidat ?></h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Jumlah Kandidat</h4>
        </div>
      </div>
<!--       <div class="w3-quarter">
        <div class="w3-container w3-teal w3-padding-16 overview">
          <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
          <div class="w3-right">
            <h3>23</h3>
          </div>
          <div class="w3-clear"></div>
          <h4>Telaj</h4>
        </div>
      </div> -->
    
    </div>
    <main class="container">
      <hr>
      
      <?php if ($pemilihan==''): ?>
      <div class="card" style="width: 40%">
          <div class="card-body">
            <label for="" class="">Tentukan Tanggal Pemilihan :</label>
            <form action="" id="form-tgl-pemilihan">
              <input type="date" class="form-control" name="tgl_mulai" style="margin-bottom: 10px">
            <label for="" class="">Tentukan Tanggal Berrakhir :</label>
              <input type="date" class="form-control" name="tgl_akhir" style="margin-bottom: 10px">
              <input type="submit" class="btn btn-success" value="Set">
            </form>
          </div>
      </div>
      <?php else: ?>
            <?php 
              $d_m = strtotime($pemilihan->tgl_mulai);
              $d_a = strtotime($pemilihan->tgl_akhir);
            ?>
          <div class="card" style="overflow: hidden;">
            <div class="card-body bg-info">
              <label for="" class="nomar " style="padding: 7px;"><b>Tanggal Pemilihan : <?php echo date('d M Y (H:i)',$d_m); ?> - <?php echo date('d M Y (H:i)',$d_a); ?></b></label> 
                <div class="btn btn-danger" id="reset-pemilihan" style="float: right;">
                  <span class="fa fa-sync"></span>
                  Reset Pemilihan
                </div>
            </div>
          </div>
          
      <?php endif ?>
      <?php if ($pemilihan<>array()): ?>
        
        <hr>
        <div class="card" id="voting-result" style="overflow: hidden;">
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
            
          <?php foreach ($kandidat as $k): ?>
            <?php foreach ($calon as $c): ?>
              <?php if ($c['nomor']==$k['no_calon']): ?>
                
                <div  class="card-body row nopad nomar" style="border-bottom: 1px #ddd solid">
                  <div class="col-2">
                    <div class="img-container">
                      <?php if ($c['foto']==''): ?>
                        <img src="<?php echo base_url('public/img/main/user.png'); ?>" alt="">
                      <?php else: ?>
                        <img src="<?php echo base_url($c['foto']) ?>" alt="" onerror="this.onerror=null;this.src='<?php echo base_url('public/img/main/user.png'); ?>';">
                      <?php endif ?>
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
                      <h5 class="jml-text" data-percent=""> <?php echo $this->Kandidat->jml_voting_kandidat($k['no_calon']); ?> Suara</h5>
                    </div>
                  </div>
                </div>

              <?php endif ?>
            <?php endforeach ?>
          <?php endforeach ?>
        </div>

      <?php endif ?>

    </main>
    <script>
      $(document).ready(function () {
        $('#form-tgl-pemilihan').on('submit',function () {

          var mulai = confirm('Setelah tanggal ditentukan anda tidak dapat mengatur calon kandidat lagi ! lanjutkan ?');
          if (mulai == true) {
            
            $.ajax({
              type : 'post',
              url : 'Admin/set_tgl_pemilihan',
              data : new FormData(this),
              contentType :false,
              cache : false,
              processData : false,
              success : function (result) {
                $('#ajax-container').html(result);
              }

            });
          }

          return false;
        });
        $('#reset-pemilihan').click(function () {
          // body...
          // alert('oke');
          var res = confirm('Mereset Pemilihan artinya menghapus jumlah perolehan dari semua Kandidat ! Lanjutkan ?');
          if (res == true ) {

            $.ajax({
              type : 'post',
              url : 'Admin/reset_pemilihan',
              success : function (result) {
                $('#ajax-container').html(result);
                // body...
              }
            });
          }else{

          }
        });

         setInterval(function () {
            // alert('ok');
            $.ajax({
              type : 'post',
              url : 'Admin/voting_result',
              success : function(result) {
                $('#voting-result').html(result);
              }
            });
          },500);

        setInterval(function () {
          // body...
          // alert('okee');
            $.ajax({
              type : 'post',
              url : 'Admin/jml_memilih',
              success : function (result) {
                $('#jml_voting').html(result);
              }
            });
        },500)

      });

     

    </script>
