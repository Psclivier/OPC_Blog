<?php

require_once 'src/DAO/BilletDAO.php';
require_once 'src/DAO/CommentDAO.php';
require_once 'view/Vue.php';

class ControleurBillet {

    private $billet;
    private $commentaire;

    public function __construct() {
        $this->billet = new BilletDAO();
        $this->commentaire = new CommentDAO();
    }

    // Display article detail
    public function billet($idBillet) {
        $billet = $this->billet->getBillet($idBillet);
        $commentaires = $this->commentaire->getCommentaires($idBillet);
        $vue = new \BlogPSC\Vue("Billet");
        $vue->generer(array('billet' => $billet, 'commentaires' => $commentaires));
    }

    // Add an article.
    public function poster($titre, $contenu){
        $this->billet->addBillet( $contenu, $titre);
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }

    // Dsiplay article edition.
    public function getPostEdit ($idBillet){
        $post = $this->billet->getBillet($idBillet);
        $vue = new \BlogPSC\Vue ("EditPost");
        $vue->generer(array('contenu' => $post['contenu'], 'titre' => $post['titre'], 'id' => $idBillet));
    }

    // Edit an article.
    public function setPostEdit ($titre, $contenu, $idBillet){
        $this->billet->updatePost($titre, $contenu, $idBillet);
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }

    //  Delete article.
    public function delArticle ($idBillet){
        $this->billet->deleteArticle($idBillet);
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }

    // Add a comment.
    public function comment($auteur, $contenu, $idBillet) {
        $this->commentaire->addComment($auteur, $contenu, $idBillet);
        $this->billet($idBillet);
    }

    // Display comment edit.
    public function getComEdit ($idCommentaire){
        $content = $this->commentaire->getComInfo($idCommentaire);
        $vue = new \BlogPSC\Vue ("EditCom");
        $vue->generer(array('contenu' => $content['contenu'], 'auteur' => $content['auteur'], 'id' => $idCommentaire));
    }

    // Edit a comment.
    public function setComEdit ($auteur, $contenu, $idCommentaire){
        $this->commentaire->updateCom($auteur, $contenu, $idCommentaire);
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));

    }

    // Delete a comment.
    public function deleteCom ($idCommentaire){
        $this->commentaire->deleteComment($idCommentaire);
        $billets = $this->billet->getBillets();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }

    // Signal a comment.
    public function signalCom($idCommentaire, $idBillet){
        $this->commentaire->incrementIndex($idCommentaire);
        $billet = $this->billet->getBillet($idBillet);
        $commentaires = $this->commentaire->getCommentaires($idBillet);
        $vue = new \BlogPSC\Vue("Billet");
        $vue->generer(array('billet' => $billet, 'commentaires' => $commentaires));


    }
    // Display text editor.
    public function gotoEditor (){
        $vue = new \BlogPSC\Vue ("Editor");
        $vue->generer([]);

    }



}

