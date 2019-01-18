<!DOCTYPE html>
<html lang="en">

<head>
    <title>Calendar Display</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendor/fullcalendar/fullcalendar.min.css" />
    <script src="<?php echo base_url() ?>assets/vendor/fullcalendar/lib/moment.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/fullcalendar/gcal.js"></script>
    <script src='<?php echo base_url() ?>assets/vendor/fullcalendar/locale/th.js'></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>ปฎิทินการไปราชการ</h1>
        </div>
    </div>

<div id="calendar">

</div>
</div>
<?php

$event = array(
            array('title'=> 'Long Event',
                    'start'=> '2019-01-07',
                    'end'=> '2019-01-10'),
            array('id'=> 999,
                    'title'=> 'Repeating Event',
                    'start'=> '2019-01-16T16:00:00')
         );


?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events : <?php echo json_encode($event);?>
    });
    });
</script>
</body>
</html>