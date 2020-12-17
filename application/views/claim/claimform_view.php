<script>
    var id = '<?php echo $user->id ?>';
    var name = '<?php echo $user->name ?>';
    var position = '<?php echo $user->position ?>';
    var driver = '<?php echo $user->driver ?>';
    var invite = '<?php echo $outsite['invite']?>';
    var lock = '<?php echo $outsite['lock']?>';
    var permit_user = '<?php echo $outsite['permit_user']?>';
    var travel_type = '<?php echo $outsite['travel_type']?>';
    var date_permit = '<?php echo $outsite['date_permit']?>';
    var invit_date = '<?php echo $outsite['invit_date']?>';
    var invit_start_date = '<?php echo $outsite['invit_start_date']?>';
    var invit_end_date = '<?php echo $outsite['invit_end_date']?>';
    var permit_start_date = '<?php echo $outsite['permit_start_date']?>';
    var permit_end_date = '<?php echo $outsite['permit_end_date']?>';
    var arr_member =
        <?php echo json_encode($outsite_member);?>;
    var arr_cars =
        <?php echo json_encode($cars);?>;

</script>
<script>
    $(document).ready(function () {
        var id = $('#id').val();
        console.log(id);
        if (!id) {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: false,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,             //Set เป็นปี พ.ศ.
                autoclose: true
            }).datepicker("setDate", "0");

        } else {
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: false,
                language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
                thaiyear: true,              //Set เป็นปี พ.ศ.
                autoclose: true
            });
        }
    });
</script>
<br>
<form>
    <input type="hidden" id="id" class="form-control " placeholder="" value="<?php echo $outsite['id'] ?>">
    <input type="hidden" id="permit_group" class="form-control" placeholder=""
           value="<?php echo $outsite['permit_group'] ?>">
    <input type="hidden" id="permit_user" class="form-control" placeholder=""
           value="<?php echo $this->session->userdata('id') ?>">
</form>

<div class="panel panel-info">
    <div class="panel-heading">
        บันทึกข้อมูลรายละเอียดการไปราชการ
    </div>
    <div class="panel-body">
        <div class="navbar navbar-default w3-theme-l5">
            <form action="#" class="navbar-form">
                <label>วันที่ขออณูญาต </label>
                <input type="text" id="date_permit" data-type="date" class="form-control datepicker"
                       data-date-language="th"
                       data-rel="tooltip" data-date-format="dd/mm/yyyy"
                       value="">

            </form>
        </div>
        <div class="form-row">

            <label> มีหนังสือเชิญประชุมหรือไม่ </label>
            <select id="invite" class="form-control" style="width: 200px">
                <option value="0"> --------</option>
                <option value="1" <?php if ($outsite['invite'] == '1') {
                    echo 'selected';
                } ?> >มีหนังสือเชิญประชุม
                </option>
                <option value="2" <?php if ($outsite['invite'] == '2') {
                    echo 'selected';
                } ?> >ไม่มี
                </option>
            </select>


        </div>
        <br>

        <div class="navbar navbar-default" id="frm_invit1">
            <form action="#" class="">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label> ประเภทการเชิญ </label>
                        <select id="invit_type" style="width: 250px;" class="form-control">
                            <option value="">ประเภทการการเชิญ</option>
                            <?php
                            foreach ($invit_type as $r) {
                                if ($outsite['invit_type'] == $r->id) {
                                    $s = 'selected';
                                } else {
                                    $s = '';
                                }
                                echo "<option value=' $r->id' $s > $r->invit_type </option>";

                            } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label> เลขที่หนังสือเชิญ </label>
                        <input type="text" class="form-control " id="invit_number" placeholder="เลขที่หนังสือราชการ"
                               value="<?php echo $outsite['invit_number']; ?>"
                            >
                    </div>
                    <div class="form-group col-md-3">
                        <label> หน่วยงานเจ้าของหนังสือ </label>
                        <input type="text" class="form-control" id="invit_name" placeholder="หน่วยงานที่เชิญ"
                               value="<?php echo $outsite['invit_name']; ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label> ลงวันที่ </label>
                        <input type="text" id="invit_date" placeholder="หนังสือราชการลงวันที่" ata-type="date"
                               class="form-control datepicker" data-date-language="th" data-date-format="dd/mm/yyyy"
                               value="<?php echo to_thai_date($outsite['invit_date']); ?>">
                    </div>

                </div>
                <div class="form-row">

                    <div class="form-group col-md-8">
                        <label> เรื่อง</label>
                        <input type="text" class="form-control" id="invit_subject" placeholder="เรื่อง"
                               value="<?php echo $outsite['invit_subject']; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label> สถานที่ไปราชการ</label>
                        <input type="text" class="form-control" id="invit_place" placeholder="ไปราชการที่"
                               value="<?php echo $outsite['invit_place']; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>วันที่ตามหนังสือเชิญ</label>
                        <input type="text" id="invit_start_date" data-type="date" class="form-control datepicker"
                               data-date-language="th"
                               data-rel="tooltip" data-date-format="dd/mm/yyyy"
                               value="<?php echo to_thai_date($outsite['invit_start_date']); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>ถึงวันที่ </label>
                        <input type="text" id="invit_end_date" data-type="date" class="form-control datepicker"
                               data-date-language="th"
                               data-rel="tooltip" data-date-format="dd/mm/yyyy"
                               value="<?php echo to_thai_date($outsite['invit_end_date']); ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="navbar navbar-default" id="frm_invit2">
            <div class="form-row">

                <div class="form-group col-md-8">
                    <label> เรื่อง</label>
                    <input type="text" class="form-control" id="invit_subject2" placeholder="เรื่อง"
                           value="<?php echo $outsite['invit_subject']; ?>">
                </div>

                <div class="form-group col-md-4">
                    <label> สถานที่ไปราชการ</label>
                    <input type="text" class="form-control" id="invit_place2" placeholder="ไปราชการที่"
                           value="<?php echo $outsite['invit_place']; ?>">
                </div>
            </div>


            <div class="form-group" style="margin: 10px">
                <label for="comment">เหตุผลที่ขอไปราชการ :</label>
                <textarea class="form-control" rows="5"
                          id="detail_no_invit" placeholder="ตัวอย่าง : ด้วยกลุ่มงานอนามัยสิ่งแวดล้อมและอาชีวอนามัย  สำนักงานสาธารณสุขจังหวัดมหาสารคาม  จะออกเก็บข้อมูลเพื่อการวิจัย/ขออนุเคราะห์ตรวจน้ำอุปโภค-บริโภคภายในโรงเรียน ตามแผนปฏิบัติราชการปีงบประมาณ 2562 "><?php echo $outsite['detail_no_invit']; ?></textarea>
            </div>
        </div>
        <div class="navbar navbar-default w3-theme-l5">
            <form action="#" class="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>วันที่ขอไปราชการ </label>
                        <input type="text" id="permit_start_date" data-type="date" class="form-control datepicker"
                               data-date-language="th"
                               data-rel="tooltip" data-date-format="dd/mm/yyyy"
                               value="<?php echo to_thai_date($outsite['permit_start_date']); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>ถึงวันที่ </label>
                        <input type="text" id="permit_end_date" data-type="date" class="form-control datepicker"
                               data-date-language="th"
                               data-rel="tooltip" data-date-format="dd/mm/yyyy"
                               value="<?php echo to_thai_date($outsite['permit_end_date']); ?>">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>วัตถุประสงค์การไปราชการ </label>
                        <input type="text" id="objective" class="form-control " data-rel="tooltip"
                               placeholder=" เช่น เพื่อประชุมเชิงปฏิบัติการพัฒนาระบบสารสนเทศ"
                               value="<?php echo $outsite['objective']; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>เบิกค่าใช้จ่ายเดินทางไปราชการจาก </label>
                        <select id="claim_type" style="width: 250px;" class="form-control">
                            <option value="">ประเภทการการเบิก</option>
                            <?php
                            foreach ($claim_type as $r) {
                                if ($outsite['claim_type'] == $r->id) {
                                    $s = 'selected';
                                } else {
                                    $s = '';
                                }
                                echo "<option value=' $r->id' $s > $r->claim_type </option>";

                            } ?>
                        </select>

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label> อื่นๆ ระบุ</label>
                        <input class="form-control" type="text" id="claim_cause"
                               value="<?php echo $outsite['claim_cause'] ?>">
                    </div>
                </div>


            </form>
        </div>

        <!--        รายชื่อไปราชการ -->

        <div class="navbar navbar-default">
            <br>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label> รายชื่อผู้ไปราชการ </label>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal">
                        <i class="fa fa-plus-circle"></i> เพิ่มรายชื่อ
                    </button>
                </div>
                <div class="col-xl-12">
                    <table class="table table-responsive" id="tbl_list">
                        <thead>
                        <th>#</th>
                        <th>ชื่อ สกุล</th>
                        <th>ตำแหน่ง</th>
                        <th>การจัดการ</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>

        </div>

        <div class="navbar navbar-default">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>เดินทางไปราชการโดย</label>
                    <select id="travel_type" style="width: 300px;" class="form-control">
                        <option value="">เดินทางไปราชการโดย</option>
                        <?php
                        foreach ($travel_type as $r) {
                            if ($outsite['travel_type'] == $r->id) {
                                $s = 'selected';
                            } else {
                                $s = '';
                            }
                            echo "<option value=' $r->id' $s > $r->travel_type </option>";
                        } ?>
                    </select>
                </div>
                <div class="form-row" style="display: none">
                    <div class="form-group col-md-6">
                        <label> อื่นๆ ระบุ</label>
                        <input class="form-control" type="text" id="travel_cause"
                               value="<?php echo $outsite['travel_cause'] ?>">
                    </div>
                </div>
                <div class="form-group col-md-6" id="txt_license_plate">
                    <label> ทะเบียนรถยนต์ (กรณีเดินทางรถยนต์ส่วนตัว) </label>
                    <input type="text" id="license_plate" class="form-control " data-rel="tooltip"
                           placeholder=" เช่น กง 1234 มหาสารคาม" value="<?php echo $outsite['license_plate']; ?>">
                </div>
            </div>
            <div class="form-row" id="frm_used_car">
                <div class="form-group col-md-12">
                    <label>รถยนต์ราชการ</label>
                    <button type="button" class="btn btn-success" id="btn_add_car">
                        <i class="fa fa-plus-circle"></i> ขอรถยนต์ราชการ
                    </button>
                </div>
                <div class="col-xl-12">
                    <table class="table table-responsive" id="tbl_car_list">
                        <thead>
                        <th>#</th>
                        <th>เลขทะเบียนรถยนต์</th>
                        <th>พนักงานขับรถยนต์</th>
                        <th>เบอร์โทร</th>
                        <th>ผู้ควบคุมรถ</th>
                        <th>การจัดการ</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
    <div class="panel-footer" style="text-align: center;">
        <button type="button" class="btn btn-primary " id="btn_save_outsite"><i class="fa fa-save "></i> บันทึก</button>
        <button type="button" class="btn btn-success" id="btn_print_pdf"><i class="fa fa-print "></i>
            พิมพ์เอกสารขออณุญาตไปราชการ
        </button>
        <a href="<?php echo site_url('/car/used_car/'.$outsite['id'])?>" class="btn btn-info" id="btn_print_car" target="_blank"><i class="fa fa-print "></i>
            พิมพใบขอใช้รถยนต์ราชการ
        </a>
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="trues">

    <div class="modal-dialog" role="document" style="width:1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-search "></i> ค้นหาสมาชิก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-inline">
                    <input type="text" class="form-control" placeholder="ค้นหา...." id="txt_search"
                           style="width: 400px;">
                    <button class="btn btn-info " id="btn_search"><i class="fa fa-search"></i> ค้นหา</button>
                </div>
                <div class="row" style="padding: 20px">
                    <table class="table table-responsive" id="tbl_search_result">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อ สกุล</th>
                            <th>ตำแหน่ง</th>
                            <th>การจัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="4">.....</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/apps/js/claim.js" charset="utf-8"></script>



