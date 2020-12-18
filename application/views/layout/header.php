

<div class="navbar-header w3-theme">
    <a class="navbar-brand w3-theme" href="<?php echo base_url()?>"><?php echo version();?>  </a>
    <a class="navbar-brand w3-theme"><?php echo $this->session->userdata('hosname')?>
    <?php echo " (".$this->session->userdata('fullname').":".$this->session->userdata('id').")"?></div></a>
<!-- /.navbar-header -->
<ul class="nav navbar-top-links navbar-right w3-theme">
    <li class="dropdown">

        <?php
        if ($this->session->userdata('id') != '') {
            echo "
<a class='dropdown-toggle' data-toggle='dropdown'' href='#'>
            <i class='fa fa-user fa-fw'></i> <i class='fa fa-caret-down'></i></a>
            <ul class='dropdown-menu dropdown-user'>
            <li><a href=" . site_url('user/user_profile/') . $this->session->userdata('id') . "><i class='fa fa-user fa-fw'></i> User Profile</a>
            </li>
             <li><a href=" . site_url('admin/') . "><i class='fa fa-user fa-fw'></i>Admin</a>
            </li>
            </li>
             <li><a href='' data-toggle='modal' data-target='#frmModal_n_year'><i class='fa fa-user fa-fw'></i>ตั้งค่าปีงบประมาณ</a>
            </li>
            <li class='divider'></li>
            <li><a href=" . site_url('user/logout') . "><i class='fa fa-sign-out fa-fw'></i> Logout</a>
            </li>
        </ul> ";
        } else {
            echo "<a class=' btn navbar-brand btn-outline' style='margin-top:10px;' href='" . site_url('user/login') . "'><i class='fa fa-sign-in' fa-2x></i>  Login </a>";
        }
        ?>
    </li>
</ul>

<div class="modal fade" id="frmModal_n_year" data-backdrop="false" >
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
               <span style="color: black;">ตั้งค่าปีงบประมาณ</span>
            </div>
            <!-- Modal body -->
            <form id="frm_n_year">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="cat_id">หมวดหมู่</label>
                        <select class="form-control" id="n_year" placeholder="หมวดหมู่" value="">
                            <?php
                            for($i=2563; $i<=2568; $i++)
                            {
                                $select='';
                                $i==$this->session->userdata('n_year') ? $select='selected':$select='';
                                        echo "<option value=".$i." ".$select.">".$i."</option>";
                            }
                            ?>
                        </select></div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_save_n_year">Save</button>
                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/apps/js/header.js" charset="utf-8"></script>