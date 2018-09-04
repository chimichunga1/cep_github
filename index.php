<?php
	require_once('support/config.php');


?>

<?php  if(isLoggedIn()): 
makeHead("CEP Project List");
require_once("template/header.php");
require_once("template/sidebar.php");
$project=$cepsystem_con->myQuery("SELECT * FROM projects WHERE is_deleted=0");


?>
<div class="page-wrapper">
  <div class="container-fluid">
    <div class="content-wrapper">
        <!-- Top breadcrumps -->
      <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
          <h3 class="text-themecolor m-b-0 m-t-0"><i class="mdi mdi-view-list"></i> Project <small class="text-success">List</small></h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href=".">Home</a></li>
              <li class="breadcrumb-item active">Project List</li>
            </ol>
        </div>
      </div>
        <!-- End of Breadcrumps     -->
          <div class="row">
            <div class="col-12">
              <div class="card">
              <div class="card-body">
                <?php
                 Alert();
                ?>
                <div class="table-responsive">
									<input type='hidden' name="student_id" id="student_id" value="<?php echo $_SESSION[WEBAPP]['user']['id']; ?>">
                    <table id='dataTables' class="table responsive-table table-bordered table-striped table-sm" >

                        <thead>
                            <tr>
                                <th width='10%'>COMPANY</th>
                                <th width='5%'>PROJECT NO</th>
                                <th width='30%'>PROJECT</th>
                                <th width='30%'>LOCATION</th>
                                <th width='10%'>CONTRACT AMNT</th>
                                <!-- <th width='10%'>DP</th> -->
                                <th width='1%'>BILLING STATUS</th>
                                <th width='20%'>ACTION</th>
                                <!-- <th></th> -->

                            </tr>
                        </thead>
                        <tbody>
                
                        <?php
                        $ctr=0;
                        while($row=$project->fetch(PDO::FETCH_ASSOC)):
                        $pr_id=$row['id'];
                        $pr_info = $con->myQuery("SELECT * FROM project_info WHERE project_id='{$pr_id}'")->fetch(PDO::FETCH_ASSOC);
                        if (empty($pr_info)) {
                            $pr_info['saba']="-";
                            $pr_info['po']="-";
                            // $pr_info['contract_amount']=0;
                            // $pr_info['downpayment']=0;
                        }
                        if (!empty($pr_info['downpayment'])) {
                            if ($pr_info['downpayment'] != 0) {
                                $progress=($pr_info['downpayment']/$pr_info['contract_amount'])*100;
                                $progress=number_format($progress,1);
                            } else {
                                
                                $progress=0;
                            }
                        } else {
                            $progress=0;
                        }
                        
                        if ($progress > 99) {
                            $bar_bg="green";
                        } else {
                            $bar_bg="#ff2f2f";
                        }
                       
                        $ctr++;
                        
                            echo "<tr>";
                            echo "<td>";
                            echo empty($pr_info['company_name'])?"":$pr_info['company_name'];
                            echo "</td>";
                            echo "<td>".$row['project_number']."</td>";
                            echo "<td class='text-left'>".$row['name']."</td>";
                            echo "<td class='text-left'>".$row['description']."</td>";
                            echo "<td class='text-right'>";
                                echo !empty($pr_info['contract_amount'])?"P".number_format($pr_info['contract_amount'],2):'-';
                            echo "</td>";
                            // echo "<td>";
                            //     echo !empty($pr_info['downpayment'])?number_format($pr_info['downpayment'],2):'-';
                            // echo "</td>";
                            
                            echo "<td>
                            
                              <input type='text' class='knob' value='{$progress}' data-skin='tron'  data-thickness='0.2' data-width='60' data-height='60' data-fgColor='{$bar_bg}' data-readonly='true'>
                            
                         
                                        
                            </td>";
                            
                            echo "<td>
                                <button class='btn btn-success' onclick='modal({$pr_id})' title='Edit'><i class='fa fa-edit'></i></button>
                                <a href='vw_project.php?id={$pr_id}'><button class='btn btn-info' title='View'><i class='fa fa-eye'></i></button></a>
                              
                            </td>";
                            
                            echo "</tr>";

                        endwhile;
                        ?>
                 
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>
        </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form autocomplete='off' action='save_proj_info.php' method="POST" >
                    
                      <div class="modal-header">
                          <h4 class="modal-title">Edit Project Information</h4>
                      </div>
                      <div class="modal-body" >
                          <input type='hidden' name='proj_id'>
                          <div class='form-group'>
                            <label>COMPANY NAME</label> <br/>
                            <input type='text' class='form-control' placeholder="---" name='company' class='form-control' value="">
                            
                          </div>
                          <div class='form-group'>
                            <label>SA/BA</label> <br/>
                            <input type='text' class='form-control' placeholder="---" name='saba' class='form-control' value="">
                            
                          </div>

                          <div class='form-group'>
                            <label>PO</label> <br/>
                            <input type='text' class='form-control' placeholder="---" name="po">
                            
                          
                          </div>
                          <div class='form-group'>
                            <label>Contract Amount</label> <br/>
                            <input type='text' class='form-control' placeholder="---" name="c_amnt" onkeypress="return isNumberKey(event,this)">
                            
                          
                          </div>
                          

                      </div>

                      <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Save</button>
                        <button class="btn btn-default" data-dismiss="modal" class='btn btn-sm btn-danger'>Cancel</button>

                      </div>
                    </form>
                  </div>
                </div>
            </div>
</div>
<?php else: 
makeHead("Login");    

Alert();

?>
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>


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

<?php endif; ?>


<script type="text/javascript">
function modal(id) {
    // var id="1";
    // console.log()
    $("#myModal").modal("show");

    $.ajax({
                url: "ajax/edit_project.php",
                method: "POST",
                data: {
                    project_id: id,
                    
                    },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    const values = data;
                    values.forEach(function(val) {
                        $('input[name="'+val.name+'"]').val(val.value);
                    });
                },
                error: function(msg){
                    console.log(msg.responseText);
                }
    });

}
    var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",

                "searching": true,
                "select":true,
                "lengthMenu": [[50, -1], [50, "All"]],
               "language": {
                    "zeroRecords": "No Project yet."
                },
                order:[[5,'desc']]

        });

    });
  
    function filter_search()
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }
    $(function () {
      $(".knob").knob({
        
        draw: function () {

          // "tron" case
          if (this.$.data('skin') == 'tron') {

            var a = this.angle(this.cv)  // Angle
                    , sa = this.startAngle          // Previous start angle
                    , sat = this.startAngle         // Start angle
                    , ea                            // Previous end angle
                    , eat = sat + a                 // End angle
                    , r = true;

            this.g.lineWidth = this.lineWidth;

            this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3);

            if (this.o.displayPrevious) {
              ea = this.startAngle + this.angle(this.value);
              this.o.cursor
                      && (sa = ea - 0.3)
                      && (ea = ea + 0.3);
              this.g.beginPath();
              this.g.strokeStyle = this.previousColor;
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
              this.g.stroke();
            }

            this.g.beginPath();
            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
            this.g.stroke();

            this.g.lineWidth = 2;
            this.g.beginPath();
            this.g.strokeStyle = this.o.fgColor;
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
            this.g.stroke();

            return false;
          }
        }
      });
    });

</script>

<?php
Modal();
makeFoot(WEBAPP);
?>
