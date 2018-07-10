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

    // Edition d'un billet.
    public function editer ($titre, $contenu, $idBillet){
        $this->billet->editBillet($titre, $contenu, $idBillet);
        $billets = $this->billet->getBillets();
        $vue = new Vue ("Edit");
        $vue->generer(array('billets' => $billets));
    }


    //  Suppression Billet.
    public function supprimerBillet ($idBillet){
        $this->billet->deleteBillet($idBillet);
        $billets = $this->billet->getBillets();
        $vue = new Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }


    // Ajoute un commentaire à un billet
    public function commenter($auteur, $contenu, $idBillet) {
        // Sauvegarde du commentaire
        $this->commentaire->ajouterCommentaire($auteur, $contenu, $idBillet);
        // Actualisation de l'affichage du billet
        $this->billet($idBillet);
    }


    // Supprimer un commentaire.
    public function supprimer ($idCommentaire){
        $this->commentaire->supprimerCommentaire($idCommentaire);
        $billets = $this->billet->getBillets();
        $vue = new Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }



}

