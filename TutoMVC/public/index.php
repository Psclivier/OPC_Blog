<?php


require '../config/dev.php';
require '../config/Autoloader.php';
\App\config\Autoloader::register();


$routeur = new \App\config\Routeur();
$routeur->routerRequete();

