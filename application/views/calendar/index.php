<!DOCTYPE html>
<html lang="en">

<head>
    <title>Calendar Display</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>vendor/fullcalendar/fullcalendar.min.css" />
    <script src="<?php echo base_url() ?>vendor/fullcalendar/lib/moment.min.js"></script>
    <script src="<?php echo base_url() ?>vendor/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url() ?>vendor/fullcalendar/gcal.js"></script>
    <script src='<?php echo base_url() ?>vendor/fullcalendar/locale/th.js'></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Calendar</h1>
        </div>
    </div>
</div>
<div id="calendar">

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#calendar').fullCalendar({

        });
    });
</script>
</body>
</html>