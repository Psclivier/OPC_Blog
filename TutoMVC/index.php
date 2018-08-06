<?php

require 'src/controller/Routeur.php';

//require 'TutoMVC/config/Autoloader.php';
//TutoMVC\config\Autoloader::register();

$routeur = new Routeur();
$routeur->routerRequete();

