<br>
<br>
<div>
<table class="table table-responsive">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อสกุล</th>
            <th>ตำแหน่ง</th>
            <th>เบอร์โทร</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach($driver as $c){
            echo "<tr>";
            echo "<td>$no</td>";
            echo "<td><a href=". site_url('user/user_profile/').$c->id."><img class='img-rounded' width='60px' src='".base_url('assets/images/users/').$c->id.".jpg' > $c->driver_name</td>";
            echo "<td>$c->position</td>";
            echo "<td>$c->user_mobile</td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </tbody>
</table>
</div>