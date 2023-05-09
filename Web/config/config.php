<?php
// Path to the root of the project
define('ROOT', str_replace('index.php', '', $_SERVER['DOCUMENT_ROOT']));

// Application name
define('APPNAME', 'Cook Master');

// Application version
define('APPVERSION', '1.0.0');

// Developer Team
define('DEVELOPER', 'Cooked Master\'s Team');

// Log file
define('LOGFILE', 'logs/log.txt');

// Dashboard or Other pages
define('DASHBOARD', 'dashboard');
define('OTHERS', 'others');
define('NO_LAYOUT', 'no_layout');

// Password 
define('PASSWORD_SALT', 'cookmaster');
define('PASSWORD_COST', 12);

// Logo
define('LOGO_SVG', 'assets/images/logo.svg');
define('LOGO_PNG', 'assets/images/logo.png');

//CONST FOR LENGHT OF columns in table users
include_once("constant/users.php");

//CONST FOR TYPE OF ACCESS
include_once("constant/access.php");

//CONST CONST FOR LENGHT OF columns in table subscriptions
include_once("constant/subscription.php");

//ALERT MESSAGES
include_once("constant/alert.php");

//CONST FOR LENGHT OF columns in table event_template
include_once("constant/eventTemplate.php");

//CONST FOR LENGHT OF columns in table event
include_once("constant/events.php");

//CONST FOR LOCATION FONCTIONNALITIES
include_once("constant/location.php");

//const for equipment
include_once("constant/equipment.php");

include_once("constant/apiKey.php");

?>