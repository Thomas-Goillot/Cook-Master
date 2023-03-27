<?php

require_once('config/const.php');
require('vendor/autoload.php');

use App\Router;

new Router($_GET['p']);

