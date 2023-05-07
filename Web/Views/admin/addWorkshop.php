<?php
include_once('Views/layout/dashboard/path.php');
?>
<div class="row">
    <div class="col-lg-4">
        <div class="card card-animate">
            <div class="card-body">
                <form action="<?= $path_prefix ?>admin/addProduct" method="POST" enctype="multipart/form-data">
                </form>
            </div>
        </div>
    </div>
</div>