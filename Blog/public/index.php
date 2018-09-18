<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config/dev.php';
require '../vendor/autoload.php';

$routeur = new \App\src\Config\Routeur();
$routeur->routerRequete();


