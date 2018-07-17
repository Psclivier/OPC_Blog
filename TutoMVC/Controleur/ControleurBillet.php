<?php

require_once 'Modele/Billet.php';
require_once 'Modele/Commentaire.php';
require_once 'Vue/Vue.php';

class ControleurBillet {

    private $billet;
    private $commentaire;

    public function __construct() {
        $this->billet = new Billet();
        $this->commentaire = new Commentaire();
    }

    // Affiche les détails sur un billet
    public function billet($idBillet) {
        $billet = $this->billet->getBillet($idBillet);
        $commentaires = $this->commentaire->getCommentaires($idBillet);
        $vue = new Vue("Billet");
        $vue->generer(array('billet' => $billet, 'commentaires' => $commentaires));
    }

    // Ajout d'un billet.
    public function poster($titre, $contenu){
        $this->billet->addBillet( $contenu, $titre);
        $billets = $this->billet->getBillets();
        $vue = new Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }

    // Afficher edition d'un billet.
    public function getPostEdit ($titre, $contenu, $idBillet, $date){
        $vue = new Vue ("EditPost");
        $vue->generer(array('contenu' => $contenu, 'titre' => $titre, 'date' => $date, 'id' => $idBillet));
    }

    // Edition d'un billet.
    public function setPostEdit ($titre, $contenu, $idBillet){
        $this->billet->updatePost($titre, $contenu, $idBillet);
        $billets = $this->billet->getBillets();
        $vue = new Vue("Accueil");
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
    public function getComEdit ($auteur, $contenu, $idCommentaire){
        $vue = new Vue ("EditCom");
        $vue->generer(array('contenu' => $contenu, 'auteur' => $auteur, 'id' => $idCommentaire));
    }

    // Edition d'un commentaire
    public function setComEdit ($auteur, $contenu, $idCommentaire){
        $this->commentaire->updateCom($auteur, $contenu, $idCommentaire);
        $billets = $this->billet->getBillets();
        $vue = new Vue("Accueil");
        $vue->generer(array('billets' => $billets));

    }

    // Supprimer un commentaire.
    public function supprimer ($idCommentaire){
        $this->commentaire->supprimerCommentaire($idCommentaire);
        $billets = $this->billet->getBillets();
        $vue = new Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }

    // Signaler un commentaire.
    public function signalCom($idCommentaire){
        $this->commentaire->incrementIndex($idCommentaire);
    }
    // Afficher la page editeur de texte.
    public function gotoEditor (){
        $vue = new Vue ("Editor");
        $vue->generer([]);

    }



}

