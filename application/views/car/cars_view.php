<br>
<br>
<div>
<table class="table table-responsive">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>เลขทะเบียนรถ</th>
            <th>ชื่อรถ</th>
            <th>จำนวนที่นั่ง</th>
            <th>ผู้รับผิดชอบ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach($car as $c){
            echo "<tr>";
            echo "<td>$no</td>";
            echo "<td>$c->licente_plate</td>";
            echo "<td>$c->name</td>";
            echo "<td>$c->seat</td>";
            echo "<td>$c->driver_name</td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </tbody>
</table>
</div>