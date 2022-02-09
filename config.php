<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('DB_HOST', "localhost");
define('DB_NAME', "schoolboard");
define('DB_USER', "root");
define('DB_PASSWORD', "olamide2020");

define('CSM', 0);
define('CSMB', 1);


require 'vendor/autoload.php';
session_start();
?>