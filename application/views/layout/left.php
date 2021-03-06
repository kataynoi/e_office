<div class="sidebar w3-theme-l5" role="navigation" style="padding-top: 15px;margin-top: 54px;">
    <div class="sidebar-nav navbar-collapse" id="left_slide" >
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" id="txt_search_link" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="btn_search_link">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="<?php echo site_url();?>"><i class="fas fa-chart-line"></i> Dashboard</a>
            </li>
            <li>
                <a href="<?php echo site_url('outsite')?>"><i class="fa fa-bus fa-fw"></i> ขออนุญาตไปราชการ<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('outsite/add_outsite_permit')?>">สร้างใบขออนุญาตปราชการ</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('outsite')?>">รายการขออนุญาตไปราชการของคุณ</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('outsite/all')?>">รายการขออนุญาตไปราชการทั้งหมด</a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('calendar/outsite')?>">ปฏิทินไปราชการ</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>


            <li>
                <a href="#"><i class="fa fa-bus fa-fw"></i> ขอใช้รถราชการ<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo site_url('/car/calendar')?>">ตารางการใช้รถ</a></li>
                    <li><a href="<?php echo site_url('/car/cars')?>">รถยนต์ราชการ</a></li>
                    <li><a href="<?php echo site_url('/car/drivers')?>"">พนักงานขับรถยนต์</a></li>
                    <?PHP
                    if(check_role('1',$this->session->userdata('id'))){
                        echo "<li role=''><a href=".site_url('/car/approve_car').">อนุมัติการใช้รถยนต์ราชการ</a></li>";
                    }
                    ?>

                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-bus fa-fw"></i> งานบุคลากร<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <!-- <li><a href="<?php echo site_url('/signin/')?>"> รายงานลงเวลาปฏิบัติราชการ</a></li> -->

                    <?PHP
                    if(check_role('1',$this->session->userdata('id'))){
                        echo "<li><a href=".site_url('/signin/')."> รายงานลงเวลาปฏิบัติราชการ</a></li>";
                    }
                    ?>

                    <li><a href="<?php echo site_url('/employee')?>"> บุคลากร</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url('admin/')?>"><i class="far fa-calendar-check">Admin</i></a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>

<script src="<?php echo base_url() ?>assets/apps/js/search.js" charset="utf-8"></script>
