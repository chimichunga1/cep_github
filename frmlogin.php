<?php
	require_once("support/config.php");

  redirect(".");
  die();

  if(!empty($_GET['id'])){
    Alert("Account set successfully." , "success");
  }
	makeHead("Login");
  alert();
?>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>

<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<section id="wrapper" class="login-register login-sidebar"  style="background-image:url(assets/images/background/login.jpg);">
  <div class="login-box card">
    <div class="card-body">
      <form class="form-horizontal form-material"  action="logingin.php" method="post">
        <a href="javascript:void(0)" class="text-center db"><img src="assets/images/icon.jpg" alt="Home" /></a>
        <!-- username password -->
        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input type="text" class="form-control " placeholder="Username" name='username' autofocus="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input type="password" class="form-control" placeholder="Password" name='password'>
          </div>
        </div>

        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
          </div>
        </div>
				<div class="form-group">
          <div class="col-md-12 text-right">
            <a href="forgot_password.php" ><i class="fa fa-lock m-r-5"></i> Forgot password?</a> </div>
        </div>
        <hr>
        <div class="form-group m-b-0">
          <!-- <div class="col-sm-12 text-center">
            <p>Don't have an account? <a href="frmregister.php" class="text-primary m-l-5"><b>Sign Up</b></a></p>
          </div> -->
        </div>
      </form>
    </div>
  </div>
</section>

</body>

<?php
  Modal();
	makeFoot();
?>
