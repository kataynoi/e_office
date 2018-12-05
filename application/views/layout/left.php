<div class="sidebar w3-theme-l5" role="navigation" style="padding-top: 15px;margin-top: 54px;">
    <div class="sidebar-nav navbar-collapse" id="left_slide" >
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="index.html"><i class="fas fa-chart-line"></i> Dashboard</a>
            </li>
            <li>
                <a href="<?php echo site_url('outsite')?>"><i class="fa fa-bus fa-fw"></i> ขออณุญาตไปราชการ<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('outsite')?>">ขออณุญาตไปราชการ</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('outsite/add_outsite_permit')?>">สร้างใบขออณุญาตไปราชการ</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('calendar/outsite')?>">ปฏิทินไปราชการ</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>


            <li>
                <a href="#"><i class="fa fa-bus fa-fw"></i> ขอใช้รถราชการ (รอก่อนนะ...)<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo site_url('/car/calendar')?>">ตารางการใช้รถ</a></li>
                    <li><a href="<?php echo site_url('/car/cars')?>">รถยนต์ราชการ</a></li>
                    <li><a href="<?php echo site_url('/car/drivers')?>"">พนักงานขับรถยนต์</a></li>
                    <?PHP
                    if($this->session->userdata('id')=='121' || $this->session->userdata('id')=='160' ||$this->session->userdata('id')=='88'||$this->session->userdata('id')=='65'){
                        echo "<li role=''><a href=".site_url('/car/approve_car').">อนุมัติการใช้รถยนต์ราชการ</a></li>";
                    }
                    ?>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fas fa-calendar-plus"></i> จองห้องประชุม (รอก่อนนะ...)<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Third Level <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="<?php echo site_url('admin/login')?>"><i class="fa fa-user-secret fa-fw"></i> ผู้ใช้งานระบบ (สำหรับ Admin)</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>