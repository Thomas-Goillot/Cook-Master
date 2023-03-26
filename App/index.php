<?php

require_once('config/const.php');

require_once(ROOT.'app/Model.php');
require_once(ROOT.'app/Controller.php');
require_once(ROOT.'app/Router.php');

$params = explode('/', $_GET['p']);

new Router($params);