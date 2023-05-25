<?php

require_once('config/config.php');
require_once('app/generalFunctions.php');
require('vendor/autoload.php');

use App\Router;

new Router(isset($_GET['p']) ? $_GET['p'] : "");
