<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-md-4 col-sm-12">
        <?php include_once('views/admin/events/events_createEventForm.php'); ?>
    </div>


    <div class="col-md-8 col-sm-12">
        <?php include_once('views/admin/events/events_calendar.php'); ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php include_once('views/admin/events/events_list.php'); ?>
    </div>
</div>