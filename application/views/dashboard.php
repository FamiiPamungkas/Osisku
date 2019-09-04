<!DOCTYPE html>
<html>
<head>
<title>Welcome to Dashboard</title>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url('framework/css/w3.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('framework/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('public/css/dashboard.css'); ?>">

  <script src="<?php echo base_url('framework/js/jquery-3.3.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('framework/js/popper.min.js'); ?>"></script>
  <script src="<?php echo base_url('framework/js/bootstrap.min.js'); ?>"></script>
  <!-- <script src="<?php echo base_url('framework/js/fontawesome-all.min.js'); ?>"></script> -->
  <script src="<?php echo base_url('framework/fa/all.js'); ?>"></script>
  <script src="<?php echo base_url('public/js/dashboard.js') ?>"></script>
  
</head>
  <?php 
    if ($this->session->status!='logged') {
      redirect(base_url('User/Login'));
    }elseif ($this->session->level=='u') {
      redirect(base_url('User'));
      # code...
    }
  ?>
<style>
  /*html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}*/
</style>
<body class="w3-light-grey">
  
<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-left"><a href="<?php echo(base_url())  ?>" style="color: #fff">Osisku Voting System</a></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
            <div class="profile-pic">
              <div class="image">
                <!-- <img id="image-profile" onerror="cekimage()" src="<?php echo base_url('public/img/main/user.png') ?>" alt=""> -->
                 <img id="profile-image" onerror="changeimage()" src="<?php echo base_url($this->session->foto); ?>" alt="">
              </div>
            </div>
    </div>
    <div class="w3-col s8 w3-bar">
      <?php $username = $this->session->username ?>
      <div class="alert alert-success" style="margin-top: 0;">
        <h6 style="line-height: 20.5px;margin: 0">Hai, <strong><?php echo ucwords($this->Model_user->get_user($username)->nama); ?></strong></h6>
        <!-- <br> -->

      </div>
      <small class="btn btn-warning"><a href="<?php echo base_url('User/Logout') ?>" style="color: #fff"><span class="fa fa-sign-out-alt"></span> Logout</a></small>
      <!-- <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a> -->
      <!-- <a href="#" role="button" data-trigger="focus" data-toggle="popover" data-placement="bottom" data-content="<a href='<?php echo base_url('User/Logout') ?>'>Logout</a>" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a> -->
      <!-- <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a> -->
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <a class="side-menu" href="#collapse" data-class="overview" data-param="" data-parent="#accordion" data-toggle="collapse" class="panel-title">
                <i class="fa fa-certificate "></i>
                <span>Overview</span>              
              </a>
            </div>
            <div class="panel-heading">
              <a href="#collapse1" data-class-parent="kelola_user" data-parent="#accordion" data-toggle="collapse" class="panel-title">
                <i class="fa fa-user "></i>
                <span>Kelola User</span>              
              </a>
            </div>
            <div id="collapse1" class="panel-collapse collapse in">
              <ul class="">
                <li id="user_list">
                  <a class="side-menu" href="#" data-class="lihat_user" data-param="" data-parent-menu='kelola_user'>
                    <i class="fa fa-user "></i>
                    <span>Lihat User</span>
                  </a>
                </li>
                <li id="parameter_kelas" data="parameter_kelas">
                  <a class="side-menu" href="#" data-class="parameter_kelas" data-param="" data-parent-menu='kelola_user'>
                    <i class="fa fa-university "></i>
                    <span>Parameter Kelas</span>
                  </a>
                </li>
               <li id="import_user" data="Import_user">
                  <a class="side-menu" href="#" data-class="import_user" data-param="" data-parent-menu='kelola_user'>
                    <i class="fa fa-file-excel "></i>
                    <span>Import Data User</span>
                  </a>
                </li>
                <li id="Input_user" data="Input_user">
                  <a class="side-menu" href="#" data-class="Input_user" data-param="" data-parent-menu='kelola_user'>
                    <i class="fa fa-edit "></i>
                    <span>Input Data User</span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="panel-heading">
              <a href="#collapse2" data-class-parent="kandidat" data-parent="#accordion" data-toggle="collapse" class="panel-title">
                <i class="fa fa-users "></i>
                <span>Kelola Kandidat</span>              
              </a>
            </div>
            <div id="collapse2" class="panel-collapse collapse in">
              <ul class="">
                <li id="kandidat_calon">
                  <a class="side-menu" href="#" data-class="kandidat_calon" data-param="" data-parent-menu='kandidat'>
                    <i class="fa fa-user "></i>
                    <span>Calon</span>
                  </a>
                </li>
                <li id="kandidat_no">
                  <a class="side-menu" href="#" data-class="kandidat_no" data-param="" data-parent-menu='kandidat'>
                    <i class="fa fa-award "></i>
                    <span>Nomor Kandidat</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
  </div>
  <div></div>
</nav>



<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <main id="ajax-container">
      <div class="ajax-loading">
        <div class="load-icon">
          <i class="fa fa-spinner fa-pulse w3-xxxlarge"> </i>
        </div>

      </div>
  </main>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>Osisku Voting System</h4>
    <p>&copy Copyright <a href="https://web.facebook.com/fame1302">Fame1302</a> 2018 Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer>

  <!-- End page content -->
    </div>
  </div>
</div>
<script>
$(document).ready(function() {



})

  function changeimage() 
  {
     $('#profile-image').attr('src','<?php echo base_url('public/img/main/user.png') ?>');
  }

// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}

$(document).ready(function () {
  // body...
  // alert('popovers');
  $('[data-toggle="popover"]').popover({html:true});
});

</script>

</body>
</html>
