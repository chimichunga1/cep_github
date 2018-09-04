<?php
require_once 'support/config.php';

if(!isLoggedIn()){
  toLogin();
    die();
}


makeHead("Change Password");



// var_dump(decryptIt($getpass['password']));
// die;

require_once("template/header.php");
require_once("template/sidebar.php");
?>
<div class='content-wrapper'>
  <section class="content-header">
    <h1 class="text-blue"><i class="fa fa-lock"></i>
      Change Password
    </h1>
    
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><i class="fa fa-cogs"></i> Maintenance</a></li>
      <li class="active">Change Password</li>
    </ol>
  </section>
  <section class='content'>
    <div class="row">
      <div class='col-md-12'>
        <div class="box box-primary">
          
          
        <div class="box-body">
        <br/>
            <?php
          Alert();
        ?>
            <form method='POST' class='form-horizontal disable-submit' action ="save_password.php">
            <input type='hidden' name='user_id' value='<?php echo htmlspecialchars("{$_SESSION[WEBAPP]['user']['user_id']}")?>'>
            
                 

                 <div class='form-group'>
                   <label class='col-md-4 text-right' >Current Password:</label>
                          <div class="col-md-5">
                            <input type="password" class="form-control" id="cur_password" placeholder="Current Password" name='cur_password'  required>
                          </div>
                    

                 </div>
                 <div class='form-group'>
                    <label class='col-md-4 text-right' >New Password:</label>
                          <div class="col-md-5">
                            <input type="password" class="form-control" id="password" placeholder="New Password" name='password' value='' required>
                          </div>
                    

                 </div>
                 <div class="form-group">
                          <label class='col-md-4 text-right' >Confirm New Password:</label>
                          <div class="col-md-5">
                            <input type="password" class="form-control" id="con_password" placeholder="Confirm Password" name='con_password' value='' required>
                          </div>
                        </div>
                        <div class="text-center">
                          <div class="form-group">
                          <div class="col-sm-8 col-md-offset-2 ">
                            <button type='submit' class='btn btn-primary btn-flat'>Save </button>
                            <a href='index.php' class='btn btn-default btn-flat'>Cancel</a>
                          </div>
                        </div>
                        </div>
                        
                 

            </form>
         
          </div>

        </div>
      </div>
    </div>
  </section>
</div>














<?php
Modal();
makeFoot();
?>