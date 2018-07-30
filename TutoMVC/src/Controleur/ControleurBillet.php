<?php

require_once 'src/DAO/BilletDAO.php';
require_once 'src/DAO/CommentDAO.php';
require_once 'Vue/Vue.php';

class ControleurBillet {

    private $billet;
    private $commentaire;

    public function __construct() {
        $this->billet = new BilletDAO();
        $this->commentaire = new CommentDAO();
    }

    // Affiche les détails sur un billet
    public function billet($idBillet) {
        $billet = $this->billet->getBillet($idBillet);
        $commentaires = $this->commentaire->getCommentaires($idBillet);
        $vue = new \BlogPSC\Vue("Billet");
        $vue->generer(array('billet' => $billet, 'commentaires' => $commentaires));
    }

    // Ajout d'un billet.
    public function poster($titre, $contenu){
        $this->billet->addBillet( $contenu, $titre);
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }

    // Afficher edition d'un billet.
    public function getPostEdit ($idBillet){
        $post = $this->billet->getBillet($idBillet);
        $vue = new \BlogPSC\Vue ("EditPost");
        $vue->generer(array('contenu' => $post['contenu'], 'titre' => $post['titre'], 'id' => $idBillet));
    }

    // Edition d'un billet.
    public function setPostEdit ($titre, $contenu, $idBillet){
        $this->billet->updatePost($titre, $contenu, $idBillet);
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }

    //  Suppression Billet.
    public function supprimerBillet ($idBillet){
        $this->billet->deleteBillet($idBillet);
        $billets = $this->billet->getBillets();
        $vue = new Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }

    // Ajouter un commentaire à un billet
    public function commenter($auteur, $contenu, $idBillet) {
        $this->commentaire->ajouterCommentaire($auteur, $contenu, $idBillet);
        $this->billet($idBillet);
    }

    // Afficher edition d'un commentaire.
    public function getComEdit ($idCommentaire){
        $content = $this->commentaire->getComInfo($idCommentaire);
        $vue = new \BlogPSC\Vue ("EditCom");
        $vue->generer(array('contenu' => $content['contenu'], 'auteur' => $content['auteur'], 'id' => $idCommentaire));
    }

    // Edition d'un commentaire
    public function setComEdit ($auteur, $contenu, $idCommentaire){
        $this->commentaire->updateCom($auteur, $contenu, $idCommentaire);
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));

    }

    // Supprimer un commentaire.
    public function supprimer ($idCommentaire){
        $this->commentaire->supprimerCommentaire($idCommentaire);
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }

    // Signaler un commentaire.
    public function signalCom($idCommentaire){
        $this->commentaire->incrementIndex($idCommentaire);
    }
    // Afficher la page editeur de texte.
    public function gotoEditor (){
        $vue = new \BlogPSC\Vue ("Editor");
        $vue->generer([]);

    }



}

