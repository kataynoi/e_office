<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ข้อมูลผู้ขอรับเกียรติบัตร
            <span class="pull-right"> <a href="<?php echo site_url() ?>/outsite/add_outsite_permit"
                                         class="btn btn-success"><i class="fa fa-save"></i> </a>
</span>

        </div>
        <div class="panel-body">

            <table id="certification_data" class="table table-responsive">
                <thead>
                <tr>
                    <th >ลำดับที่</th>
                    <th >ชื่อสกุล</th>
                    <th >Certification</th>
                </tr>
                </thead>
            </table>
        </div>

    </div>

</div>


<script src="<?php echo base_url() ?>assets/apps/js/certification.js" charset="utf-8"></script>