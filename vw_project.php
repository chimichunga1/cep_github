<?php
require_once("support/config.php");
require_once("template/pic_modal.php");
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
$pr_dp_info=$con->myQuery("SELECT * FROM project_info WHERE project_id={$_GET['id']}")->fetch(PDO::FETCH_ASSOC);
$bal = $pr_dp_info['contract_amount'] - $pr_dp_info['downpayment'];
if ($pr_info['owner_id'] != "0") {
  $owner_info=$cepsystem_con->myQuery("SELECT id,CONCAt(first_name,' ',last_name) as name FROM employees WHERE id={$pr_info['owner_id']}")->fetch(PDO::FETCH_ASSOC);
} else {
  $owner_info['name'] = ' - ';
}
$pr_dp=$con->myQuery("SELECT * FROM project_downpayment WHERE first_dp=0 and final_dp=0 AND project_id={$_GET['id']}");
$pr_dp2=$con->myQuery("SELECT * FROM project_downpayment WHERE first_dp=0 and final_dp=0 AND project_id={$_GET['id']}");
$pr_dp_all=$con->myQuery("SELECT * FROM project_downpayment WHERE project_id={$_GET['id']}");
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
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='control-label'> Contract Amount: <b>P<?php echo number_format($pr_dp_info['contract_amount'],2); ?></b> </label>
                                </div>
                                
                           
                            </div>
                            
                            
                        </div>
                        <div class='row'>
                            <div class='col-md-6'>
                                <!-- <div class='form-group'>
                                    <label class='control-label'> Owner: <b><?php echo $owner_info['name']; ?></b> </label>
                                </div> -->
                            </div>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <label class='control-label'> Balance: <b>P<?php echo number_format($bal,2); ?></b> </label>
                                </div>
                           
                            </div>
                            
                            
                        </div>
                        <div class='row'>
                            <div class='col-md-12'>
                                <!-- <div class='form-group'> -->
                                    <label class='control-label'> Progress Billing: <b>
                                    <?php $progress = ($pr_dp_info['downpayment']/$pr_dp_info['contract_amount'])*100; 
                                        
                                        if ($progress > 49) {
                                            $bar_bg="bg-success";
                                        } else {
                                            $bar_bg="bg-danger";
                                        }
                                    ?>
                                    </b></label>
                                <!-- </div> -->
                                <div class='progress' style="height:30px">
                                            <div class='progress-bar {$bar_bg}' style='width:<?php echo $progress; ?>%'><b><?php echo number_format($progress,0)."%"; ?></b></div>
                                </div>
                                <br>
                            </div>
                           
                            <br>
                            
                        <div class="container">
                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-secondary"><i class="fa fa-money-bill-alt"></i>&nbsp;Billing</button>
                              <button type="button" class="btn btn-secondary"><i class="fa fa-pencil-alt"></i>&nbsp;Drawing</button>
                              <button type="button" class="btn btn-secondary"><i class="fa fa-info"></i>&nbsp;Others</button>
                            </div>  


                            <button onclick="modal()" class='btn btn-info text-left' style="float:right;"><span class='fa fa-plus'></span> Add Payment</button> 
                          </div>

<!--                           <div class="container">
                            <center>
                            <div class="row">

                              <div class="card col-md-4" style="width: 18rem;">

                                <i class="fa fa-money-bill-alt"></i>
                                <div class="card-body">
              
                                </div>
                              </div>

                              <div class="card col-md-4" style="width: 18rem;">

                                <i class="fa fa-eye"></i>
                                <div class="card-body">
              
                                </div>
                              </div>

                              <div class="card col-md-4" style="width: 18rem;">

                                <i class="fa fa-eye"></i>
                                <div class="card-body">
              
                                </div>
                              </div>


                            </div>
                            </center>
                          </div> -->
                          
                        </div>

              
                        
                      
                    </div>
                    <hr>
                    <div class = "row">
                        <div class='col-md-12'>

        <!--                     <button onclick="modal()" class='btn btn-info text-left' style="float:right;"><span class='fa fa-plus'></span> Add Payment</button> -->
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
                                      <th width='10%'><?php echo ordinal($ctr_all)." Accomplishment Billing"; ?></th>
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
                    <div class='row'>
                            <div class='col-md-11' >
                              <h4 style="float:right;">Total Project Cost: <b>P<?php echo number_format($pr_dp_info['contract_amount'],2); ?></b></h4><br><br>
                              <h4 style="float:right;">Balance: <b>P<?php echo number_format($bal,2); ?></b></h4>
                            </div>
                    </div>
                    <br><br>
               
                    <div class="form-body">
                    
                        <div class='row'>
                            <div class='col-md-10'>
                            <h4>Payment Details</h4>
                            <table  class="table responsive-table " >
                                    <tr class="text-info h5">
                                        <th>PAYMENT</th>
                                        <th>MODE OF PAYMENT</th>
                                        <th>OR NO/VOUCHER NO</th>
                                        <th>ATTACHMENT</th>
                                    </tr>
                                
                                    <?php 
                                        $ctr=0;
                                
                                        while($row=$pr_dp_all->fetch(PDO::FETCH_ASSOC)): 
                                        echo "<tr>";
                                        
                                        if (!empty($row['first_dp'])) {
                                            echo "<td>Downpayment</td>";

                                        } elseif(!empty($row['dp'])) {
                                            $ctr++;
                                            echo "<td>".ordinal($ctr)." Accomplishment Billing</td>";
                                        } elseif(!empty($row['retention'])) {
                                            echo "<td>Retention</td>";
                                        } else {
                                            echo "<td>Final Payment</td>";
                                        }
                                        if ($row['payment_type'] == "1") {
                                            echo "<td>Cash</td>";
                                        } else {
                                            echo "<td>Check</td>";
                                        }
                                        $or_name = explode(".",$row['attachment_name']);
                                        echo "<td>".$or_name[0]."</td>";
                                        echo "<td><a href='#{$or_name[0]}' onclick='show_image_modal(\"{$row['attachment']}\",\"{$row['id']}\",\"{$row['payment_type']}\")'>Click here</a></td>";
                                        echo "</tr>";
                                        endwhile;
                                    ?>
                                </tr>
                              </table>

                            </div>
                        </div>
                    </div>
                
                
        </div>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form autocomplete='off' action='save_vw_project.php' method="POST" enctype="multipart/form-data" onsubmit='return check_amount(this)'>
                    
                      <div class="modal-header">
                          <h4 class="modal-title">Add Downpayment</h4>
                      </div>
                      <div class="modal-body" >
                          <input type='hidden' name='proj_id' value="<?php echo $_GET['id']; ?>">
                          <input type='hidden' name='proj_balance' id='proj_balance' value="<?php echo $bal; ?>">
                       
                          <div class='form-group'>
                            <label>Payment Type</label> <br/>
                            <select class='form-control cbo' data-placeholder="Select downpayment type" name='dp_type' style='width:100%;' required>
                              <option value=''></option>
                              <option value='1'>Downpayment</option>
                              <option value='2'>Accomplishment Billing</option>
                              <option value='3'>Retention</option>
                              <option value='4'>Final Payment</option>
                              
                            </select>
                          </div>
                          <div class='form-group'>
                            <label>Mode of Payment</label> <br/>
                            <select class='form-control cbo' data-placeholder="Select payment type" onchange="GetType(this);" name='p_type' id='p_type' style='width:100%;' required>
                              <option value=''></option>
                              <option value='1'>Cash</option>
                              <option value='2'>Check</option>
                             
                              
                            </select>
                          </div>
                         
                          <div id="check" style="display:none;">
                            <div class='form-group'>
                                <label>Bank</label> <br/>
                                <input type='text' class='form-control'  placeholder="---" name="c_bank" id="">
                                
                            
                            </div>
                            <div class='form-group'>
                                <label>Bank Branch</label> <br/>
                                <input type='text' class='form-control'  placeholder="---" name="c_branch" id="">
                                
                            
                            </div>
                            <div class='form-group'>
                                <label>Check No.</label> <br/>
                                <input type='text' class='form-control'  placeholder="---" name="c_cn" id="">
                                
                            
                            </div>
                            <div class='form-group'>
                                <label>Check Date</label> <br/>
                                <input type='date' class='form-control' value="<?php echo date("Y-m-d"); ?>"  name="c_date" >
                                
                            
                            </div>
                          </div>
                          <div class='form-group'>
                            <label>Amount</label> <br/>
                            <input type='text' class='form-control' onkeyup="validate_amount()" onchange="check_amount()" placeholder="---" name="amnt" id="amnt" onkeypress="return isNumberKey(event,this)" required>
                            
                          </div>
                          <div class='form-group'>
                            <label>Date Collected</label> <br/>
                            <input type='date' class='form-control' value="<?php echo date("Y-m-d"); ?>"  name="date" >
                            
                          
                          </div>
                          <div class='form-group'>
                            <label>Attachment</label> <br/>
                              <div class="custom-file">
                              
                                  <input id="logo" type="file" name="files[]" accept="image/*" class="custom-file-input" multiple>
                                  <label id="validate" for="logo" class="custom-file-label">Choose file...</label>
                              </div>
                          </div>    

                      </div>

                      <div class="modal-footer">
                        <button type="submit" id="submitButton" class="btn btn-info" disabled>Save</button>
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
function show_image_modal(filename,id,p_type){
    // alert(p_type);
            $("#img_modal").attr("src","attachment/"+filename);
            $("#img_download").attr("href","attachment/"+filename);
            $("#PicModal").modal("show");
            if (p_type=="2") {
                $('#modal_check').show();
            } else {
                $('#modal_check').hide();
            }
            $.ajax({
                url: "ajax/payment_info.php",
                method: "POST",
                data: {
                    id: id,
                    
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
function GetType(val) {
    
    var p_type =$("#p_type").val();

    // alert(p_type);

    if (p_type=="2") {
        $('#check').show();
    } else {
        $('#check').hide();
    }
    // var amnt = parseFloat($("#amnt").val());

    // if (amnt > balance) {
    //     $("#submitButton").attr("disabled", true); 
    //     alert("Amount exceeded to remaining balance of P"+balance);
    //     $("#amnt").formatCurrency();
    //     $("#amnt").focus();
        
        
    // } else {
    //     $("#submitButton").attr("disabled", false); 
    //     $("#amnt").formatCurrency();
    //     document.getElementById("submit").disabled = false;
    //     return true;
    // }
    // return true;
    
}
function check_amount() {
    
    var balance = parseFloat($("#proj_balance").val());
    var amnt = parseFloat($("#amnt").val());

    if (amnt > balance) {
        $("#submitButton").attr("disabled", true); 
        alert("Amount exceeded to remaining balance of P"+balance);
        $("#amnt").formatCurrency();
        $("#amnt").focus();
        
        
    } else {
        $("#submitButton").attr("disabled", false); 
        $("#amnt").formatCurrency();
        document.getElementById("submit").disabled = false;
        return true;
    }
    return true;
    
}
function validate_amount() {
    
    var balance = parseFloat($("#proj_balance").val());
    var amnt = parseFloat($("#amnt").val());

    if (amnt > balance) {
        $("#submitButton").attr("disabled", true); 
        alert("Amount exceeded to remaining balance of P"+balance);
        $("#amnt").formatCurrency();
        $("#amnt").focus();
        
        
    } else {
        $("#submitButton").attr("disabled", false); 
        $("#amnt").formatCurrency();
        document.getElementById("submit").disabled = false;
        return true;
    }
    return true;
    
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
