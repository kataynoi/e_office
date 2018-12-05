<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo version();?></title>
    <script src="<?php echo base_url()?>vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url()?>vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url()?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>vendor/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css">

    <![endif]-->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Kanit');
    </style>
</head>
<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div>
                <?php echo $header_for_layout?>
        </div>
        <div>
                <?php echo $left_for_layout?>
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    <div>
        <div id="page-wrapper">
        <?php echo $content_for_layout?>
        </div>
    </div>
    <div>
        <?php echo $footer_for_layout?>
    </div>

    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->


<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url()?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>vendor/jquery-ui/jquery-ui.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url()?>vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->


<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url()?>dist/js/sb-admin-2.js"></script>

<script src="<?php echo base_url()?>vendor/js/underscore.min.js"></script>
<script src="<?php echo base_url()?>vendor/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url()?>vendor/js/jquery.cookie.min.js"></script>
<script src="<?php echo base_url()?>vendor/js/jquery.freeow.min.js"></script>
<script src="<?php echo base_url()?>vendor/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url()?>vendor/js/jquery.numeric.js"></script>
<script src="<?php echo base_url()?>vendor/js/numeral.min.js"></script>
<script src="<?php echo base_url()?>assets/apps/js/apps.js"></script>
<link href="<?php echo base_url()?>vendor/datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<script src="<?php echo base_url()?>vendor/datepicker/dist/js/bootstrap-datepicker-custom.js"></script>
<script src="<?php echo base_url()?>vendor/datepicker/dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: false,
            language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            thaiyear: false              //Set เป็นปี พ.ศ.
        }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน
    });
</script>
<script type="text/javascript" charset="utf-8">
    var site_url = '<?php echo site_url()?>';
    var base_url = '<?php echo base_url()?>';

    var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
</body>

</html>
