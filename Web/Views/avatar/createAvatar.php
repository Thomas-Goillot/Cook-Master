<?php
include_once('Views/layout/dashboard/path.php');
?>

<div class="row" style="max-height: 60vh;">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0 p-0">Aperçu de votre avatar</h4>
                </div>

                <div id="avatar_preview" class="w-100" style="min-height: 60vh;">
                    <?= $avatar ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-animate">
            <div class="card-body">

                <div class="card-title d-flex justify-content-between align-items-center">
                    <h4 class="card-title m-0 p-0">Création d'un avatar</h4>
                    <button type="button" class="btn btn-warning" onclick="random_avatar()">Aléatoire</button>
                    <button type="button" class="btn btn-primary" onclick="save_avatar()">Enregistrer</button>
                </div>

                <ul class="nav nav-tabs justify-content-center align-content-center">
                    <li class="nav-item">
                        <a class="nav-link nav-list active text-dark" onclick="avatar_items_list(this,'head_list')">Cheveux</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-list text-dark" onclick="avatar_items_list(this,'eyes_list')">Yeux</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-list text-dark" onclick="avatar_items_list(this,'nose_list')">Nez</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-list text-dark" onclick="avatar_items_list(this,'mouth_list')">Bouche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-list text-dark" onclick="avatar_items_list(this,'brows_list')">Sourcils</a>
                    </li>
                </ul>
                <div class="row container-fluid pt-5 items show" id="head_list">

                    <?php
                    $parameter = 'head';
                    $dir = 'assets/images/avatar/' . $parameter . '/';
                    $files = scandir($dir);
                    foreach ($files as $file) {
                        if (strpos($file, $parameter) !== false) {
                            echo '
                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <label class="form-check-label item" for="' . $file . '">
                            <img src="' . $path_prefix . $dir . $file . '" class="img-fluid rounded-circle" alt="" data-id="' . $parameter . '" loading="lazy">
                            <input type="radio" class="form-check-input" name="' . $parameter . '_radio" id="' . $file . '" onclick="change_item(this)">
                        </label>
                    </div>';
                        }
                    }
                    ?>
                </div>
                <div class="row container-fluid pt-5 items hide" id="eyes_list">
                    <?php
                    $parameter = 'eyes';
                    $dir = 'assets/images/avatar/' . $parameter . '/';
                    $files = scandir($dir);
                    foreach ($files as $file) {
                        if (strpos($file, $parameter) !== false) {
                            echo '
                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <label class="form-check-label item" for="' . $file . '">
                            <img src="' . $path_prefix . $dir . $file . '" class="img-fluid rounded-circle" alt="" data-id="' . $parameter . '" loading="lazy">
                            <input type="radio" class="form-check-input" name="' . $parameter . '_radio" id="' . $file . '" onclick="change_item(this)">
                        </label>
                    </div>';
                        }
                    }
                    ?>
                </div>
                <div class="row container-fluid pt-5 items hide" id="nose_list">
                    <?php
                    $parameter = 'nose';
                    $dir = 'assets/images/avatar/' . $parameter . '/';
                    $files = scandir($dir);
                    foreach ($files as $file) {
                        if (strpos($file, $parameter) !== false) {
                            echo '
                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <label class="form-check-label item" for="' . $file . '">
                            <img src="' . $path_prefix . $dir . $file . '" class="img-fluid rounded-circle" alt="" data-id="' . $parameter . '" loading="lazy">
                            <input type="radio" class="form-check-input" name="' . $parameter . '_radio" id="' . $file . '" onclick="change_item(this)">
                        </label>
                    </div>';
                        }
                    }
                    ?>
                </div>
                <div class="row container-fluid pt-5 items hide" id="mouth_list">
                    <?php
                    $parameter = 'mouth';
                    $dir = 'assets/images/avatar/' . $parameter . '/';
                    $files = scandir($dir);
                    foreach ($files as $file) {
                        if (strpos($file, $parameter) !== false) {
                            echo '
                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <label class="form-check-label item" for="' . $file . '">
                            <img src="' . $path_prefix . $dir . $file . '" class="img-fluid rounded-circle" alt="" data-id="' . $parameter . '" loading="lazy">
                            <input type="radio" class="form-check-input" name="' . $parameter . '_radio" id="' . $file . '" onclick="change_item(this)">
                        </label>
                    </div>';
                        }
                    }
                    ?>
                </div>
                <div class="row container-fluid pt-5 items hide" id="brows_list">
                    <?php
                    $parameter = 'brows';
                    $dir = 'assets/images/avatar/' . $parameter . '/';
                    $files = scandir($dir);
                    foreach ($files as $file) {
                        if (strpos($file, $parameter) !== false) {
                            echo '
                    <div class="col-lg-4 col-md-4 col-sm-6 col-6 ">
                        <label class="form-check-label item" for="' . $file . '">
                            <img src="' . $path_prefix . $dir . $file . '" class="img-fluid rounded-circle" alt="" data-id="' . $parameter . '" loading="lazy">
                            <input type="radio" class="form-check-input" name="' . $parameter . '_radio" id="' . $file . '" onclick="change_item(this)">
                        </label>
                    </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>


    </div>
</div>