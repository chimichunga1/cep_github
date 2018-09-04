
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo !empty($pageTitle)?$pageTitle:WEBAPP; ?></title>
    <link rel="icon" type="image/gif/png" href="assets/images/icon_bak_transpa.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 4 -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link href="assets/material/css/material-kit.css" rel="stylesheet"/> -->

     <!-- chartist CSS -->
     <link href="assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/material/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="assets/material/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- Font Awesome 4.7.0 -->
    <link rel="stylesheet" href="assets/material/css/icons/font-awesome/css/font-awesome.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/material/css/icons/ionicons-2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    
    

    <link rel="stylesheet" href="assets/ContentTools/sandbox/sandbox.css">
    <!-- Theme style -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
<style>
body {
    font-family: 'Roboto';
}

.ct-widget .ct-ignition__button--edit{
    background:#1e88e5
}
.ct-widget .ct-ignition__button--edit:hover{
    background:#1e88e5
}
</style>




    <!-- <link rel="stylesheet" href="assets/plugins/datatables/media/css/dataTables.bootstrap.css"> -->

        <!-- daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="assets/plugins/icheck/skins/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="assets/plugins/colorpicker/bootstrap-colorpicker.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/dist/css/select2.min.css">


    <!-- <link rel="stylesheet" href="dist/css/AdminLTE.min.css"> -->
    <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/plugins/bootstrap-datepicker/datepick-bootstrap.css">

     <link rel="stylesheet" href="assets/plugins/sweetalert/sweetalert.css">
    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="assets/plugins/jquery/jQuery-2.1.4.min.js"></script>

      <!-- <link rel="stylesheet" href="plugins/fullcalendar/fullcalendar.print.css" media="print"> -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style type="text/css">
    th,td{
        text-align: center;
    }
    #ResultTable td{
        /*word-break: break*/
    }
</style>
<style type="text/css">
      a.pns {
       display: inline-block;
        margin-bottom: 10px;
        border-radius: 0;
        float:left;
        clear:left;
    }
</style>
  </head>

<?php
if($pageTitle=="Login"):
?>
<body class="hold-transition login-page" style="">
<?php
elseif($pageTitle=="Set Password" || $pageTitle=="Register"):
?>
<body class="hold-transition login-page" style="">
<?php
elseif($pageTitle=="Print"):
?>
<body>
<?php
else:
?>
    <body class="hold-transition skin-green-light fixed sidebar-mini ">
    <div class="wrapper">
<?php
endif;
?>
<script type="text/javascript">
    function isNumberKey(evt, element) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
        return false;
      else {
        var len = $(element).val().length;
        var index = $(element).val().indexOf('.');
        //alert(index);
        
        if (index >= 0 && charCode == 46) {
          return false;
        }
      }
      
      return true;
    } 
    

</script>