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

// INCLUDE ALL THE CONSTANTS FILES IN THE CONFIG/CONSTANT FOLDER
$directory = 'config/constant';
foreach (scandir($directory) as $file) {
    $path = $directory . '/' . $file;
    if (is_file($path)) include_once($path);
}


?>