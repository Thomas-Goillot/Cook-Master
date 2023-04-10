<?php

require_once('config/config.php');
require('vendor/autoload.php');

use App\Router;

new Router($_GET['p']);
