<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18"><?= $this->getPageName($page_name) ?></h4>
        </div>
    </div>

    <div class="col-sm-12 col-lg-6">
        <div class="page-title-right">
            <ol class="breadcrumb m-0 justify-content-end">
                <li class="breadcrumb-item"><a href="javascript: void(0);"><?= APPNAME ?></a></li>
                <?php

                foreach ($page_name as $name => $path) {
                    echo "<li class='breadcrumb-item'><a href='" . $path_prefix . "" . $path . "'>$name</a></li>";
                }

                ?>
            </ol>
        </div>
    </div>
</div>