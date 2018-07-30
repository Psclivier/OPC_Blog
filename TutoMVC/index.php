<?php

require 'src/Controleur/Routeur.php';

//require '../config/Autoloader.php';
//App\config\Autoloader::register();

$routeur = new Routeur();
$routeur->routerRequete();

