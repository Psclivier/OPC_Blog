<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 02/07/2018
 * Time: 10:00
 */
require_once 'Vue/Vue.php';
require_once 'Modele/Billet.php';
require_once 'Modele/Commentaire.php';

Class ControleurAdmin {

    private $billet;
    private $commentaire;

    public function __construct() {
        $this->billet = new Billet();
        $this->commentaire = new Commentaire();
    }
}