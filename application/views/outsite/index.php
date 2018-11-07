<script src="<?php echo base_url()?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url()?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url()?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">



<html>
<body>
<br>
<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ข้อมูลการขออนุญาตไปราชการ
            <span class="pull-right"> <a href="<?php echo site_url()?>/outsite/add_outsite_permit" class="btn btn-success"><i class="fa fa-save"></i> สร้างใบขออณุญาตไปราชการ</a>
</span>

        </div>
        <div class="panel-body">

            <table id="outsite_data" class="table table-responsive">
                <thead>
                <tr>
                    <th width="20%">วันที่ไปราชการ</th>
                    <th width="30%">เรื่อง</th>
                    <th width="15%">สถานที่</th>
                    <th width="20%">ผู้เชิญ</th>
                    <th width="15%">การจัดการ</th>

                </tr>
                </thead>
            </table>
        </div>

    </div>

</div>


<script src="<?php echo base_url()?>assets/apps/js/outsite.index.js" charset="utf-8"></script>