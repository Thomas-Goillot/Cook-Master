<?php
include_once('Views/layout/dashboard/path.php');
?>

<div class="row">
    <div class="col-4">
        <?php include_once('Views/admin/events/events_createEventForm.php'); ?>
    </div>


    <div class="col-8">
        <?php include_once('Views/admin/events/events_calendar.php'); ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?php include_once('Views/admin/events/events_list.php'); ?>
    </div>
</div>