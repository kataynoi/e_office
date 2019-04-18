<?php
/**
 * Created by PhpStorm.
 * User: Spider
 * Date: 20-Mar-19
 * Time: 10:00 AM
 */

?>
<ul class="breadcrumb">
    <li><a href="<?php echo site_url()?>">หน้าหลัก </a></li>
    <li><a href="<?php echo site_url()."/reports/"?>">รายงาน</a></li>
    <li class="active">รายงาน การลงเวลาปฏิบัติราชการ</li>
</ul>

<div class="navbar navbar-default">
    <form action="#" class="navbar-form">
        <label class="control-label"> ปี </label>
        <select id="sl_year" style="width: 200px;" class="form-control">
            <option value="<?php echo year()+543;?>"> เลือกปี </option>
            <?php
            $s='';
            for($i=2562;$i<=2570;$i++){
                $i==(year()+543)?$s='selected':$s='';
                echo '<option value='.($i-543).' '.$s.'>'.$i.'</option>';
            }
            ?>

        </select>

        <label class="control-label"> เดือน  </label>
        <select id="sl_month" style="width: 200px;" class="form-control">
            <option value=""> เลือกเดือน </option>
            <?php
            $str=get_thai_month();
            //echo $s[1];
            $i=1;$st='';
            $month_number='';
            $month = DATE(n);
            //echo $month;
            foreach($str as $s){
                $i==$month?$st='selected':$st='';
                $i<10?$month_number='0'.$i:$month_number=$i;
                echo '<option value='.$month_number.' '.$st.'>'.$s.'</option>';
                $i++;
            }
            ?>

        </select>

        <label class="control-label"> กลุ่มงาน  </label>
        <select id="sl_workgroup" style="width: 200px;" class="form-control">
            <option value=""> ระบุกลุ่มงาน </option>
            <?php

            foreach($sl_group as $s){
                echo '<option value='.$s->id.'>'.$s->name.'</option>';
                $i++;
            }
            ?>

        </select>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" id="get_sign" data-name='btn_show'>
                <i class="glyphicon glyphicon-search"></i> แสดง
            </button>
        </div>
    </form>
</div>
<table class="table table-bordered" style="font-size: smaller" id="tbl_list">
    <thead>
   <!-- <tr>
        <th>#</th>
        <th>ชื่อ สกุล</th>
        <th>จัดการ</th>
        <?php
/*        for($i=1;$i<=31;$i++){
            echo "<th>".$i."</th>";
        }
        */?>
    </tr>-->

    </thead>
    <tbody>
        <?php
/*            for($r=1;$r<=3;$r++) {
                echo "<tr>";
                if ($r == 1) {
                    echo "<td rowspan='3'>1</td>";
                    echo "<td rowspan='3'>นายเดชาชิต  แก้วม่วง</td>";
                    echo "<td style='font-size:10px;padding: 1px;margin: 2px'>เวลามา</td>";
                } else if ($r == 2) {
                    echo "<td style='font-size:10px;padding: 1px;margin: 2px'>เวลากลับ</td>";
                } else if ($r == 3) {
                    echo "<td style='font-size:10px;padding: 1px;margin: 2px'>หมายเหตุ</td>";
                }
                    for ($i = 1; $i <= 31; $i++) {
                        echo "<td style='font-size:10px;padding: 1px;margin: 2px'>08.43</td>";
                    }
                    echo "</tr>";

            }
            */?>

    </tbody>
</table>

<label>
    <ul class="list-group" style="font-size: 10px;font-weight: lighter">
        <?php

        foreach($sign_type as $s){
            echo "<li class='list-group-item'>".$s->s_type." = ".$s->sign_type."</li>";
    }
        ?>
    </ul>


</label>
<script src="<?php echo base_url() ?>assets/apps/js/sign.js" charset="utf-8"></script>