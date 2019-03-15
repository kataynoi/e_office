<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">


<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ข้อมูลการขออนุญาตใช้รถราชการ
            <span class="pull-right"> <a href="<?php echo site_url() ?>/outsite/add_outsite_permit"
                                         class="btn btn-success"><i class="fa fa-save"></i> </a>
</span>

        </div>
        <div class="panel-body">

            <table id="outsite_data" class="table table-responsive">
                <thead>
                <tr>
                    <th width="15%">การจัดการ</th>
                    <th width="15%">วันที่ไปราชการ</th>
                    <th width="30%">เรื่อง/สถานที่</th>
                    <th width="15 %">ผู้ขออณุญาติ</th>
                    <th width="15 %">รถยนต์</th>

                </tr>
                </thead>
            </table>
        </div>

    </div>

</div>


<div class="modal fade" id="approveCarModal" tabindex="-1" role="dialog" aria-labelledby=""
     aria-hidden="trues">
    <div class="modal-dialog" role="document" style="width:800px; padding: 50px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-search "></i> อนุมัติการใช้งานรถยนต์ทางราชการ </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id='outsite_id' class="form-control" type="hidden" value="xx">
                <form>
                    <input type="hidden" id="id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">อนุมัติและจัดรถยนต์ราชการ</label>
                        <select id="approve" class="form-control">
                            <?php
                            //$used_car['approve']='1';
                            $approve =array('รออนุมัติ','อนุมัติ','ไม่อนุมัติ');
                            foreach ($approve as $key => $value) {
                                echo "<option value='$key' > $value </option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group" id="frm_approve">
                        <label for="exampleInputPassword1">รถยนต์ที่ใช้</label>
                        <select id="car_id" class="form-control">
                            <option value="">รถยนต์</option>
                            <?php
                            foreach ($cars as $r) {
                                echo "<option value='$r->id' > $r->licente_plate [$r->name] </option>";
                            } ?>
                        </select>

                        <label for="exampleInputPassword1">พนักงานขับรถยนต์</label>
                        <select id="driver" class="form-control">
                            <option value="">พนักงานขับรถยนต์</option>
                            <?php
                            foreach ($driver as $r) {
                                echo "<option value='$r->user_id' > $r->driver_name </option>";
                            } ?>
                        </select>
                    </div>

                    <div class="form-group" id="frm_not_approve">
                        <label for="exampleInputPassword1">เหตุผลที่ไม่อนุมัติ</label>
                        <textarea id="cause" rows="3" class="form-control">

                        </textarea>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="btn_save_approve" data-btn="btn_save_approve" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/apps/js/approve_car.js" charset="utf-8"></script>