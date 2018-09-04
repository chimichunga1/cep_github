<?php
require_once 'support/config.php';

if(!isLoggedIn()){
  toLogin();
    die();
}


makeHead("Account Settings");



$stud_info=$cepsystem_con->myQuery("SELECT * FROM users WHERE id=?",array($_SESSION[WEBAPP]['user']['id']))->fetch(PDO::FETCH_ASSOC);
// var_dump(decryptIt($getpass['password']));
// die;

require_once("template/header.php");
require_once("template/sidebar.php");
?>

<div class="page-wrapper">
  <div class="container-fluid">
    <div class="content-wrapper">
        <!-- Top breadcrumps -->
      <div class="row page-titles">
        <div class="col-md-12 col-12 align-self-center">
          <h3 class="text-themecolor m-b-0 m-t-0"><i class="mdi mdi-account-settings-variant"></i> Account Settings</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href=".">Home</a></li>
              <li class="breadcrumb-item">Maintenance</li>
              <li class="breadcrumb-item active">Account Settings</li>
            </ol>
        </div>
      </div>
        <!-- End of Breadcrumps     -->

      <div class="row">

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="mdi mdi-account-settings-variant"></i> Personal Information</h4>
                                <h6 class="card-subtitle">change your personal information</h6>
                                <form class="form p-t-20" method="POST" action ="save_setting.php" enctype="multipart/form-data">
                                <input type='hidden' name='user_id' value='<?php echo htmlspecialchars("{$stud_info['id']}")?>'>
                                <input type="hidden" id='section_id' name="section_id" value='<?php echo !empty($stud_info)?$stud_info['section']:""?>'>
                                    <div class='form-group'>
                                      <div class='col-md-12 '>
                                        <center>
                                         
                                          <div class="text-muted">


                                          <?php
                                            echo htmlspecialchars("{$_SESSION[WEBAPP]['user']['username']}")
                                          ?>
                                          </div>

                                        </center>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputuname">Contact Number</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"></div>
                                            <input type="number" value="<?php echo $stud_info['mobile_no']; ?>" class="form-control" id="contact" placeholder="Contact Number" name='contact'  required>
                                        </div>
                                    </div>

                                 




                                    <button type="submit" style="float:right;" class="btn btn-info waves-effect waves-light m-r-10"><i class="fa fa-save"></i> Save</button>
                                    <!-- <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><i class="mdi mdi-security"></i>Change Password</h4>
                                <h6 class="card-subtitle">update/change password</h6>
                                <form class="form p-t-20" method="POST" action ="save_password.php" >
                                  <input type='hidden' name='user_id' value='<?php echo htmlspecialchars("{$_SESSION[WEBAPP]['user']['user_id']}")?>'>
                                    <div class="form-group">
                                        <label for="exampleInputuname2">Current Password</label>
                                        <div class="input-group">
                                        <input type="password" class="form-control" id="cur_password" placeholder="Current Password" name='cur_password'  required>
                                            <div class="input-group-addon"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputuname2">New Password</label>
                                        <div class="input-group">
                                        <input type="password" class="form-control" id="password" placeholder="New Password" name='password' value='' required>
                                            <div class="input-group-addon"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputuname2">Confirm New Password</label>
                                        <div class="input-group">
                                        <input type="password" class="form-control" id="con_password" placeholder="Confirm Password" name='con_password' value='' required>
                                            <div class="input-group-addon"></div>
                                        </div>
                                    </div>


                                    <div class="text-left" style="float:right;">
                                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10"><i class="fa fa-save"></i> Save</button>

                                        <!-- <a href='.' class='btn btn-inverse waves-effect waves-light'>Cancel</a> -->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

    </div>
  </div>
</div>


<script type="text/javascript">
    $('.custom-file-input').on('change', function() {
       let fileName = $(this).val().split('\\').pop();
       $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>







<?php
Modal();
makeFoot();
?>
