<?php

require_once 'src/DAO/BilletDAO.php';
require_once 'Vue/Vue.php';


class ControleurAccueil {

    private $billet;

    public function __construct() {
        $this->billet = new BilletDAO();
    }

// Affiche la liste de tous les billets du blog
    public function accueil() {
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }


}

