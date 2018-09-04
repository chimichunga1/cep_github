<?php
if(!empty($pageTitle) && $pageTitle!="Login"):
?>
</div><!-- ./wrapper -->
<?php
endif;


?>


    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- <script src="assets/material/js/material-kit.js" type="text/javascript"></script> -->

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/material/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="assets/material/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="assets/material/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/material/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- end -->
    <!-- This is data table -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>

    <!-- <script src="plugins/datatables/jquery.dataTables.min.js"></script> -->
	<!-- <script src="plugins/datatables/dataTables.bootstrap.min.js"></script> -->



    <script type="text/javascript" src="assets/plugins/datatables/media/js/jszip.min.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/media/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/media/js/vfs_fonts.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/media/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/media/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/media/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/media/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="assets/plugins/datatables/media/js/buttons.print.min.js"></script>

    <!-- FastClick -->
    <script src="assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- jvectormap -->
    <script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="assets/plugins/Chart.js/Chart.min.js"></script>
    <script src="assets/plugins/Chart.js/legend.js"></script>
     <!-- InputMask -->
    <script src="assets/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="assets/plugins/input-mask/jquery.inputmask.numeric.extensions.js"></script>
    <script src="assets/plugins/input-mask/jquery.inputmask.regex.extensions.js"></script>
    <!-- Select2 -->
    <script src="assets/plugins/select2/dist/js/select2.full.min.js"></script>
    <!-- date-range-picker -->
    <script src="assets/plugins/moment/min/moment.min.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/bootstrap-datetimepicker.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/bootstrap-datetimepicker3.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap time picker -->
    <script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap-filestyle.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert-dev.js"></script>
    <script src="assets/plugins/knob/knob.js"></script>


    <script type="text/javascript">

     $('select').select2({
        placeholder:$(this).data("placeholder")
  });
  $('select').each(function(index,element){
    if(typeof $(element).data("selected") !== "undefined"){
    $(element).val($(element).data("selected")).trigger("change");
    }
  });
    	$(function(){



        $(".date_picker").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        // $(".currency").inputmask("numeric", {"allowPlus":false,"allowMinus":false,"decimalProtect":false});
        $(".currency").inputmask("currency");
        $('.numeric').inputmask('Regex', {
            regex: "^[0-9]+"
        });
        $(".unsigned_integer").inputmask("unsigned_integer");

        $('.date_picker').datepicker();

        //Time picker
        $('.time_picker').timepicker({minuteStep:1});
    	//Date range picker
        $('.date_range').daterangepicker();
        //Date range picker with time picker
        $('.date_time_range').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    	});

        $(".bootstrap-timepicker-hour").addClass("numeric");
        $(".bootstrap-timepicker-minute").addClass("numeric");

        $(".date_picker").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        $('.date_time_picker').datetimepicker();
        $('.date_time_picker').each(function(index,element){
            if(typeof $(element).data("default") !== "undefined"){
            //$(element).val($(element).data("default")).trigger("change");
            $(element).data("DateTimePicker").defaultDate(new Date($(element).data("default")));

            }

          });
        $(".disable-submit").submit(function () {

            $(this).closest('form').find(':submit').button("loading");
        });
        function update_time() {

            cur=moment($('#date_time').html(),"MMMM DD, YYYY dddd hh:mm A").add(1,"m");
            $('#date_time').html(cur.format("MMMM DD, YYYY dddd hh:mm A"));
        }

        setInterval(function(){update_time()}, 60000);

        function is_future_date(check_date) {
            // body...
            if(Date.parse(check_date) > Date.parse("<?php echo date("m/d/Y"); ?>")){
              return true;
            }
            else{
                return false;
            }
        }
        
    $.ajaxSetup({ cache: false });

    </script>

    <script src="assets/plugins/fullcalendar/fullcalendar.js"></script>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                    <h4 class="modal-title" id="myModalLabel">


                    </h4>

                </div>

                <div class="modal-body">



                    <div class='panel-body ' >
                        <form class='form-horizontal' autocomplete="off" action='save_chapter.php' method="POST" >
                            <input type='hidden' name='edit_id' value='' id='edit_id'>
                            <input type="hidden" value="<?php echo $_GET['book_id']; ?>" name='book_id'>
                            <div class='form-group'>
                                <label class="col-md-12 control-label"> Type : <span class='text-red'>*</span> </label>
                                <div class='col-md-12'>
                                    <select name="type" data-placeholder="Type" id='type' class="form-control select2 text-blue" style='width:100%' required>
                                        <?php
                                            echo makeOptions($type);

                                        ?>
                                    </select>


                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-12 control-label">Description : <span class='text-red'>*</span> </label>
                                <div class="col-md-12">
                                <input type='text' placeholder="Description" class='form-control' name='description' id='des' >
                                </div>

                            </div>

                            <div class="modal-footer">

                                <button type='submit' class='btn-flat btn btn-info' ><span class="fa fa-save"></span> Save</button>
                               <!--  <a href="delete.php?t=ch&book_id=<?php echo $_GET['book_id']; ?>" class='btn btn-danger'><i class='fa fa-trash'></i> Delete --></a>

                                <button class="btn btn-default" data-dismiss="modal" class='btn btn-sm btn-danger'>Cancel</button>

                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>


  </body>
</html>
