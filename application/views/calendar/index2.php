<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <?php

            $month_start = strtotime('first day of this month', time());
            $month_end = strtotime('last day of this month', time());

            $year_start = strtotime('first day of January', time());
            $year_end = strtotime('last day of December', time());

/*            echo "วันแรกของเดือน ".date('D', $month_start).'<br/>';
            echo "วันแรกของเดือน ".date('N', $month_start).'<br/>';*/
            echo date('D, M jS Y', $month_end).'<br/>';
            $start_day = date('N', $month_start);
            $end_day = date('t', $month_start);
            echo " Number ".$end_day."<br>";
            ?>

        </div>
        <table class="table table-bordered">
            <thead >
            <th class="text-center"> อาทิตย์ </th>
            <th class="text-center"> จันทร์ </th>
            <th class="text-center"> อังคาร</th>
            <th class="text-center"> พุธ </th>
            <th class="text-center"> พฤหัสบดี </th>
            <th class="text-center"> ศุกร์ </th>
            <th class="text-center"> เสาร์ </th>
            </thead>
            <tbody>
                <?php
                echo "<tr>";
                for ($i=1;$i<=35;$i++){
                    $date_now = $i-$start_day;
                    if($i > $end_day+$start_day || $date_now <=0 ){
                        echo "<td></td>";
                    }else{
                        echo "<td> $date_now </td>";
                    }
                    if($i%7 == 0 ){
                        if($i !=35 ){
                            echo "</tr><tr>";
                        }else{
                            echo "</tr>";
                        }
                    }else{
                        echo "";} ;
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    echo $calendar;
    ?>
</div>
