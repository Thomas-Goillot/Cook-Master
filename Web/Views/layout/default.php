<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('head.php');?>

</head>

<body>

    <div id="layout-wrapper">

        <?php include_once('sidebar.php'); ?>

        <?php include_once('header.php'); ?>

        <div class="main-content">

            <?= $content ?>

            <?php include_once('footer.php')?>

        </div>

    </div>

    <?php include_once('script.php') ?>

</body>

</html>