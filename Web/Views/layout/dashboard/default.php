<!DOCTYPE html>
<html lang="en">

<head>

    <?= $head ?>

</head>

<body>

    <div id="layout-wrapper">

        <?= $sidebar ?>

        <?= $header ?>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?= $content ?>

                </div>
            </div>

            <?= $footer ?>

        </div>

    </div>

    <?= $script ?>

</body>

</html>