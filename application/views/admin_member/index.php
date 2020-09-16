<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> สมาชิก
             <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i class="fa fa-plus-circle"></i> Add</button>
</span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th><th>คำนำหน้า</th><th>ชื่อ สกุล</th><th>เลขบัตรประชาชน</th><th>เพศ</th><th>ตำแหน่ง</th><th>รหัสหน่วยบริการ</th><th>ประเภทพนักงาน</th><th>กลุ่่มงาน</th><th>Username</th><th>E-Mail</th><th>Password</th><th>โทรศัพย์</th><th>วันเริ่มทำงาน</th><th>วันสิ้นสุดการทำงาน</th><th>ประเภทผู้ใช้งาน</th><th>ที่อยู่</th><th>สถานะการใช้งาน</th><th>พนักงานขับรถ</th><th>ลำดับในกลุ่มงาน</th>
                    <th>#</th>
                </tr>
                </thead>

            </table>
        </div>

    </div>

</div>


<div class="modal fade" id="frmModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มสมาชิก</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" id="action" value="insert">
        <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value=""><div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="ID" value=""></div><div class="form-group">
                    <label for="prename">คำนำหน้า</label>
                    <input type="text" class="form-control" id="prename" placeholder="คำนำหน้า" value=""></div><div class="form-group">
                    <label for="name">ชื่อ สกุล</label>
                    <input type="text" class="form-control" id="name" placeholder="ชื่อ สกุล" value=""></div><div class="form-group">
                    <label for="cid">เลขบัตรประชาชน</label>
                    <input type="text" class="form-control" id="cid" placeholder="เลขบัตรประชาชน" value=""></div><div class="form-group">
                    <label for="sex">เพศ</label>
                    <input type="text" class="form-control" id="sex" placeholder="เพศ" value=""></div><div class="form-group">
                    <label for="position">ตำแหน่ง</label>
                    <input type="text" class="form-control" id="position" placeholder="ตำแหน่ง" value=""></div><div class="form-group">
                    <label for="hospcode"></label>
                    <select  class="form-control" id="hospcode" placeholder="" value="">
                        <option>-------</option>
                        <?php
                        foreach ($chospital as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="employee_type">ประเภทพนักงาน</label>
                    <select  class="form-control" id="employee_type" placeholder="ประเภทพนักงาน" value="">
                        <option>-------</option>
                        <?php
                        foreach ($employee_type as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="group">กลุ่่มงาน</label>
                    <select  class="form-control" id="group" placeholder="กลุ่่มงาน" value="">
                        <option>-------</option>
                        <?php
                        foreach ($co_workgroup as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div><div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" value=""></div><div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="text" class="form-control" id="email" placeholder="E-Mail" value=""></div><div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" placeholder="Password" value=""></div><div class="form-group">
                    <label for="user_mobile">โทรศัพย์</label>
                    <input type="text" class="form-control" id="user_mobile" placeholder="โทรศัพย์" value=""></div><div class="form-group">
                    <label for="date_in"></label>
                    <input type="text" class="form-control" id="date_in" placeholder="" value=""></div><div class="form-group">
                    <label for="date_out"></label>
                    <input type="text" class="form-control" id="date_out" placeholder="" value=""></div><div class="form-group">
                    <label for="user_level">ประเภทผู้ใช้งาน</label>
                    <input type="text" class="form-control" id="user_level" placeholder="ประเภทผู้ใช้งาน" value=""></div><div class="form-group">
                    <label for="address">ที่อยู่</label>
                    <input type="text" class="form-control" id="address" placeholder="ที่อยู่" value=""></div><div class="form-group">
                    <label for="active">สถานะการใช้งาน</label>
                    <input type="text" class="form-control" id="active" placeholder="สถานะการใช้งาน" value=""></div><div class="form-group">
                    <label for="driver">พนักงานขับรถ</label>
                    <input type="text" class="form-control" id="driver" placeholder="พนักงานขับรถ" value=""></div><div class="form-group">
                    <label for="order">ลำดับในกลุ่มงาน</label>
                    <input type="text" class="form-control" id="order" placeholder="ลำดับในกลุ่มงาน" value=""></div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btn_save">Save</button><button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/admin_member.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->