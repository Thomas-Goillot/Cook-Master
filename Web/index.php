<?php

require_once('config/config.php');
require('vendor/autoload.php');

use App\Router;

new Router($_GET['p']);

/* use Models\Subscription;

$subscription = new Subscription();

var_dump($subscription->getSubscriptions());
 */