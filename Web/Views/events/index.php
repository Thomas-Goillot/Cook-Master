<head>
    <link href="<?= $path_prefix ?>assets/css/events/styles1.css" rel="stylesheet" />
</head>
<?php
    include_once('Views/layout/dashboard/path.php');
?>

<div class="row">
                <?php
                    foreach($getAllEvents as $info){
                         echo   '<div class="col-xl-6">
                                    <div class="card ">
                                            <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="carousel-item active">
                                                        <img src="' . $path_prefix  . 'assets/images/events/' . $info['image'] . '" class="img-thumbnail sombre">
                                                        <div class="carousel-caption">
                                                            <a href="'. $path_prefix.'EventsPresentation/EventDisplay/'.$info['id_event'].'" ><h3 class="text-white">' . $info['name'] . '</h3></a>
                                                            <p>' . $info['slug'] . '</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>';
                    }
                ?>
</div>

