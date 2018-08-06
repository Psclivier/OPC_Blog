<?php

require_once 'src/DAO/BilletDAO.php';
require_once 'view/Vue.php';


class ControleurAccueil {


    private $billet;

    public function __construct() {
        $this->billet = new BilletDAO();
    }

// Dsiplay every articles of the blog
    public function accueil() {
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }


}

