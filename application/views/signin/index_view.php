<?php
/**
 * Created by PhpStorm.
 * User: Spider
 * Date: 20-Mar-19
 * Time: 10:00 AM
 */

?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>ชื่อ สกุล</th>
        <?php
        for($i=1;$i<=31;$i++){
            echo "<th>".$i."</th>";
        }
        ?>
    </tr>

    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>นายเดชาชิต  แก้วม่วง</td>
            <?php
            for($i=1;$i<=31;$i++){
                echo "<td>/ล</td>";
            }
            ?>
        </tr>
    </tbody>
</table>
