<meta charset="utf-8" />
<title><?= APPNAME ?> - <?= $this->getPageName($page_name) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta content="WebApp for <?= APPNAME ?>" name="description" />
<meta content="<?= DEVELOPER ?>" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!-- App favicon -->
<link rel="shortcut icon" href="<?= $path_prefix ?>assets/images/logo.svg">

<!-- Plugins css -->
<link href="<?= $path_prefix ?>plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />

<link href="<?= $path_prefix ?>plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

<!-- Map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.css" />
<link rel="stylesheet" type="text/css" href="https://unpkg.com/leaflet.markercluster@1.3.0/dist/MarkerCluster.Default.css" />

<!-- App css -->
<link href="<?= $path_prefix ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $path_prefix ?>assets/css/theme.min.css" rel="stylesheet" type="text/css" />

<!-- Custom css -->
<?php
if (isset($newCss) && $newCss != "") {
    echo $newCss;
}
?>