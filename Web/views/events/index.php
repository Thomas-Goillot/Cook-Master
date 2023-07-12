<head>
    <link href="<?= $path_prefix ?>assets/css/events/styles1.css" rel="stylesheet" />
</head>
<?php
    include_once('views/layout/dashboard/path.php');
?>

<div class="row">
                <?php
                if($getAllEvents ==NULL){
                    echo "<h1>Aucun évenement à venir</h1>";
                }else{
                    foreach($getAllEvents as $info){
                         echo   '<div class="col-xl-6">
                                    <div class="card ">
                                            <div id="carouselExampleCaption" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="carousel-item active">
                                                        <a href="'. $path_prefix.'EventsPresentation/EventDisplay/'.$info['id_event'].'" >
                                                            <img src="' . $path_prefix  . 'assets/images/event/' . $info['image'] . '" class="img-thumbnail sombre">
                                                            <div class="carousel-caption">
                                                                <h3 class="text-white">' . $info['name'] . '</h3>
                                                                <p>' . $info['slug'] . '</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>';
                    }
                }
                ?>
</div>

