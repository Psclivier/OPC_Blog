<?php

namespace App\src\controller;

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

class FrontController {

    private $article;
    private $comment;

    public function __construct() {
        $this->article = new ArticleDAO();
        $this->comment = new CommentDAO();
    }

// Display every articles of the blog
    public function home() {
        $data = $this->article->getArticles();
        $vue = new View("Home");
        $vue->generer(array('data' => $data));
    }


    // Display article detail
    public function article($idArticle) {
        $article = $this->article->getArticle($idArticle);
        $comments = $this->comment->getComments($idArticle);
        $vue = new View("Article");
        $vue->generer(array('article' => $article, 'comments' => $comments));
    }

    // Add an article.
    public function addarticle($titre, $contenu){
        $this->article->addarticle( $contenu, $titre);
        $data = $this->article->getArticles();
        $vue = new View("Home");
        $vue->generer(array('data' => $data));
    }

    // Display text editor.
    public function gotoEditor (){
        $vue = new View("Editor");
        $vue->generer([]);

    }

    // Display article edition.
    public function getPostEdit ($idBillet){
        $article = $this->article->getArticle($idBillet);
        $vue = new View("EditPost");
        $vue->generer(array('article' => $article));
    }

    // Edit an article.
    public function setPostEdit ($titre, $contenu, $idBillet){
        $this->article->updatePost($titre, $contenu, $idBillet);
        $data = $this->article->getArticles();
        $vue = new View("Home");
        $vue->generer(array('data' => $data));
    }

    //  Delete article.
    public function delArticle ($idBillet){
        $this->article->deleteArticle($idBillet);
        $data = $this->article->getArticles();
        $vue = new View("Home");
        $vue->generer(array('data' => $data));
    }

    // Add a comment.
    public function comment($auteur, $contenu, $idBillet) {
        $this->comment->addComment($auteur, $contenu, $idBillet);
        $this->article($idBillet);
    }

    // Display comment edit.
    public function getComEdit ($idCommentaire){
        $content = $this->comment->getComInfo($idCommentaire);
        $vue = new View("EditCom");
        $vue->generer(array('contenu' => $content['contenu'], 'auteur' => $content['auteur'], 'id' => $idCommentaire));
    }

    // Edit a comment.
    public function setComEdit ($auteur, $contenu, $idCommentaire){
        $this->comment->updateCom($auteur, $contenu, $idCommentaire);
        $data = $this->article->getArticles();
        $vue = new View("Home");
        $vue->generer(array('data' => $data));

    }

    // Delete a comment.
    public function deleteCom ($idCommentaire){
        $this->comment->deleteComment($idCommentaire);
        $data = $this->article->getArticles();
        $vue = new View("Home");
        $vue->generer(array('data' => $data));
    }

    // Signal a comment.
    public function signalCom($idCommentaire, $idBillet){
        $this->comment->incrementIndex($idCommentaire);
        $article = $this->article->getArticle($idBillet);
        $comments = $this->comment->getComments($idBillet);
        $vue = new View("Article");
        $vue->generer(array('article' => $article, 'comments' => $comments));
    }


}