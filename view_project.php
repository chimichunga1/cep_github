<?php
require_once("support/config.php");

if(!isLoggedIn()){
  toLogin();
  die();
}
makeHead("View Project");
if (empty($_GET['id'])) {
  redirect(".");
}
Alert();
$pr_info=$cepsystem_con->myQuery("SELECT * FROM projects WHERE id={$_GET['id']}")->fetch(PDO::FETCH_ASSOC);
if ($pr_info['owner_id'] != "0") {
  $owner_info=$cepsystem_con->myQuery("SELECT id,CONCAt(first_name,' ',last_name) as name FROM employees WHERE id={$pr_info['owner_id']}")->fetch(PDO::FETCH_ASSOC);
} else {
  $owner_info['name'] = ' - ';
}
$pr_dp=$con->myQuery("SELECT * FROM project_downpayment WHERE first_dp=0 and final_dp=0 AND project_id={$_GET['id']}");
$pr_dp2=$con->myQuery("SELECT * FROM project_downpayment WHERE first_dp=0 and final_dp=0 AND project_id={$_GET['id']}");
$first_dp=$con->myQuery("SELECT * FROM project_downpayment WHERE first_dp!=0 AND project_id={$_GET['id']}")->fetch(PDO::FETCH_ASSOC);
$final_dp=$con->myQuery("SELECT * FROM project_downpayment WHERE final_dp!=0 AND project_id={$_GET['id']}")->fetch(PDO::FETCH_ASSOC);
                            
require_once("template/header.php");
require_once("template/sidebar.php");
?>
<div class="page-wrapper">
  <div class="container-fluid">
    <div class="content-wrapper">
    
  <!-- Content Header (Page header) -->
  <!-- Top breadcrumps -->
      <div class="row page-titles">
      
            <div class='col-md-12'>

                <a href = "." class='btn btn-info text-left' style="float:left;"><span class='fa fa-arrow-left'></span> Back to project list  </a>
            <br><br></div>
          
        <div class="col-md-6 col-8 align-self-center">
         
          <h3 class="text-themecolor m-b-0 m-t-0"> Project : <?php echo $pr_info['name']; ?></h3>
   
        </div>
        <div class="col-md-6 col-8 align-self-center">
         
          <h5 class="m-b-0 m-t-0"> Project Number: <b><?php echo $pr_info['project_number']; ?></b></h5>
   
        </div>
        
        <div class="col-md-12">
            <br>
               
                    <div class="form-body">
                    
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='control-label'> Location: <b><?php echo $pr_info['description']; ?></b> </label>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='control-label'> Mobilization Date: <b><?php echo date_format(date_create($pr_info['start_date']),"M d, Y"); ?></b> </label>
                                </div>
                            </div>
                            
                        </div>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='control-label'> Owner: <b><?php echo $owner_info['name']; ?></b> </label>
                                </div>
                            </div>
                            
                            
                        </div>

              
                        
                      
                    </div>
                    <hr>
                    <div class = "row">
                        <div class='col-md-12'>

                            <button onclick="modal()" class='btn btn-info text-left' style="float:right;"> Add Downpayment  <span class='fa fa-plus'></span></button>
                        </div>
                      
                    </div>
                    <div class="table-responsive m-t-40">
                        <table  class="table responsive-table " >
                        <input type='hidden' name="student_id" id="student_id" value="<?php echo $_SESSION[WEBAPP]['user']['id']; ?>">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Downpayment</th>
                                    <?php 
                                      $ctr_all=0;
                                      while($row=$pr_dp->fetch(PDO::FETCH_ASSOC)): 
                                      $ctr_all++;
                                    ?>
                                      <th><?php echo $row['dp_name']; ?></th>
                                    <?php endwhile; ?>
                                    
                                    
                                    <th>Final Payment</th>
                              
                                </tr>
                            </thead>
                            <tbody>
                            <!-- Downpayment -->
                            <?php 
                              echo "<tr><td>".$first_dp['date_dp']."</td><td>P".number_format($first_dp['first_dp'],2)."</td>";
                          
                              
                            
                              echo "</tr>";
                            ?>
                            

                            <?php 
                              $ctr=0;
                     
                              while($row=$pr_dp2->fetch(PDO::FETCH_ASSOC)): 
                                
                              $ctr++;
                            ?>
                                      <tr>
                                      
                                      <?php
                                          echo "<td>".$row['date_dp']."</td>";
                                          for ($a=0; $a<$ctr; $a++) {
                                            echo "<td></td>";
                                          }
                                      ?>
                                      
                                      <td>P<?php echo number_format($row['dp'],2); ?></td>
                            <?php 
                              endwhile; 
                             
                            ?>
                            <tr>
                            <?php 
                              echo "<tr>";
                              echo "<td>";
                              if (!empty($final_dp['date_dp'])) {
                                echo $final_dp['date_dp'];
                              } else {
                                echo "-";
                              }
                              echo "</td>";
                              for ($a=0; $a<$ctr+1; $a++) {
                                echo "<td></td>";
                              }
                              echo "<td>";
                              if (!empty($final_dp['final_dp'])) {
                                echo "P".number_format($final_dp['final_dp'],2);
                              } else {
                                echo "-";
                              }
                              
                                
                                
                              echo "</td></tr>";
                            ?>

                            </tbody>
                        </table>
                    </div>
                
                
        </div>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form autocomplete='off' action='save_proj_info.php' method="POST" >
                    
                      <div class="modal-header">
                          <h4 class="modal-title">Add Downpayment</h4>
                      </div>
                      <div class="modal-body" >
                          <input type='hidden' name='proj_id' value="<?php echo $_GET['id']; ?>">
                       
                          <div class='form-group'>
                            <label>Downpayment Type</label> <br/>
                            <select class='form-control cbo' data-placeholder="Select downpayment type" name='saba' style='width:100%;' required>
                              <option value=''></option>
                              <option value='1'>Downpayment</option>
                              <option value='2'>Accomplishment Billing</option>
                              <option value='3'>Retention</option>
                              <option value='4'>Final Payment</option>
                              
                            </select>
                          </div>
                          <div class='form-group'>
                            <label>Payment Type</label> <br/>
                            <select class='form-control cbo' data-placeholder="Select payment type" name='saba' style='width:100%;' required>
                              <option value=''></option>
                              <option value='1'>Cash</option>
                              <option value='2'>Check</option>
                             
                              
                            </select>
                          </div>
                          <div class='form-group'>
                            <label>Amount</label> <br/>
                            <input type='text' class='form-control' placeholder="---" name="c_amnt" onkeypress="return isNumberKey(event,this)">
                            
                          
                          </div>
                          <div class='form-group'>
                            <label>Date</label> <br/>
                            <input type='date' class='form-control' value="<?php echo date("Y-m-d"); ?>"  name="date" >
                            
                          
                          </div>
                          <div class='form-group'>
                            <label>Attachment</label> <br/>
                              <div class="custom-file">
                              
                                  <input id="logo" type="file" name='image' accept=''  class="custom-file-input">
                                  <label id="validate" for="logo" class="custom-file-label">Choose file...</label>
                              </div>
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
<script type="text/javascript">
function modal() {
    // var id="1";
    // console.log()
    $("#myModal").modal("show");

 

}
var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX": false,
                "searching": true,
               
                "select":true,
                
                order:[[0,'desc']]

        });

    });

    function filter_search()
    {
            dttable.ajax.reload();
            //console.log(dttable);
    }

    $('.custom-file-input').on('change', function() {
       
       var filename = $(".custom-file-input").val();

        // Use a regular expression to trim everything before final dot
        var extension = filename.replace(/^.*\./, '');

        // Iff there is no dot anywhere in filename, we would have extension == filename,
        // so we account for this possibility now
        if (extension == filename) {
            extension = '';
        } else {
            // if there is an extension, we convert to lower case
            // (N.B. this conversion will not effect the value of the extension
            // on the file upload.)
            extension = extension.toLowerCase();
        }

        if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'pdf') {
          let fileName = $(this).val().split('\\').pop();
          $(this).next('.custom-file-label').addClass("selected").html(fileName);
                
    
        } else {
          // $(".custom-file-input").value = '';
          swal("Please upload image or PDF file","","warning");
        }
    });

</script>
<?php
Modal();
makeFoot();
?>
