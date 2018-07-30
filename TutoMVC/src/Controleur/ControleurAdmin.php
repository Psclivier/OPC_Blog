<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 02/07/2018
 * Time: 10:00
 */
require_once 'Vue/Vue.php';
require_once 'src/DAO/BilletDAO.php';
require_once 'src/DAO/CommentDAO.php';

Class ControleurAdmin {

    private $billet;
    private $commentaire;

    public function __construct() {
        $this->billet = new BilletDAO();
        $this->commentaire = new CommentDAO();
    }

    public function moderation(){
        $commentaires = $this->commentaire->getAllCom();
        $vue = new \BlogPSC\Vue ("ComMod");
        $vue->generer(array('commentaires' => $commentaires));
    }
}