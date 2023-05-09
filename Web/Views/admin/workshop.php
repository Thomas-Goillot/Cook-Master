<?php
include_once('Views/layout/dashboard/path.php');
?>
<div class="d-flex justify-content-center">
    <div class="col-lg-4">
        <div class="card card-animate">
            <div class="card-body">
                <form action="<?= $path_prefix ?>WorkshopAdmin/index" method="POST" enctype="multipart/form-data">
                    <?php include_once('Views/admin/workshop/form.php'); ?>
                </form>
            </div>
        </div>
    </div>
</div>