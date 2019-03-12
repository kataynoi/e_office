<div class="row" style="padding-top: 20px">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge" id="percent_audit"><?php echo $count_outsite;?></div>
                        <div>การขออนญาติไปราชการ</div>
                    </div>
                </div>
            </div>
            <a href="<?php echo site_url('/demographic/')?>">
                <div class="panel-footer">
                    <span class="pull-left">รายละเอียด</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge" id="percent_audit_true"><?php echo $count_usecar; ?></div>
                        <div>จำนวนครั้งการขอใช้รถ</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">รายละเอียด</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count_approve_car;?></div>
                        <div>รถยนต์ที่ได้รับอนุมัติ</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">รายละเอียดเพิ่มเติม</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count_users;?></div>
                        <div>ผู้ใช้งาน</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">รายละเอียดเพิ่มเติม</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        <Label>รายการไปราชการวันนี้</Label>
    </div>
    <div class="panel-body">
        <div class="row">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 30%">เรื่องที่ไปราชการ</th>
                    <th style="width: 20%">สถานที่ไปราชการ</th>
                    <th style="width: 25%">กลุ่มงาน</th>
                    <!--<th style="width: 20%">วันที่</th>-->
                </tr>
                </thead>
                <tbody>
                <?php
                $line = 0;
                foreach($outsite_today as $r){
                    $line++;
                    echo "<tr>";
                    echo "<td>$line</td>";
                    echo "<td>$r->objective</td>";
                    echo "<td>$r->invit_place</td>";
                    echo "<td>".get_group_name_by_user($r->permit_user)."</td>";
                    //echo "<td>".to_thai_date($r->permit_start_date)." - ".to_thai_date($r->permit_end_date)."</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

