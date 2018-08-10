<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 06/08/2018
 * Time: 16:33
 */


namespace src\controller;



use src\DAO\ArticleDAO;
use src\DAO\CommentDAO;

require_once 'src/DAO/ArticleDAO.php';
require_once 'view/Vue.php';

class FrontController {

    private $article;
    private $comment;

    public function __construct() {
        $this->article = new ArticleDAO();
        $this->comment = new CommentDAO();
    }

// Display every articles of the blog
    public function home() {
        $articles = $this->article->getArticles();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('articles' => $articles));
    }


    // Display article detail
    public function article($idArticle) {
        $article = $this->article->getArticle($idArticle);
        $comments = $this->comment->getComments($idArticle);
        $vue = new \BlogPSC\Vue("Article");
        $vue->generer(array('article' => $article, 'comments' => $comments));
    }

    // Add an article.
    public function addarticle($titre, $contenu){
        $this->article->addarticle( $contenu, $titre);
        $articles = $this->article->getArticles();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('articles' => $articles));
    }

    // Display text editor.
    public function gotoEditor (){
        $vue = new \BlogPSC\Vue ("Editor");
        $vue->generer([]);

    }

    // Display article edition.
    public function getPostEdit ($idBillet){
        $article = $this->article->getArticle($idBillet);
        $vue = new \BlogPSC\Vue ("EditPost");
        $vue->generer(array('article' => $article));
    }

    // Edit an article.
    public function setPostEdit ($titre, $contenu, $idBillet){
        $this->article->updatePost($titre, $contenu, $idBillet);
        $articles = $this->article->getArticles();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('articles' => $articles));
    }

    //  Delete article.
    public function delArticle ($idBillet){
        $this->article->deleteArticle($idBillet);
        $articles = $this->article->getArticles();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('articles' => $articles));
    }

    // Add a comment.
    public function comment($auteur, $contenu, $idBillet) {
        $this->comment->addComment($auteur, $contenu, $idBillet);
        $this->article($idBillet);
    }

    // Display comment edit.
    public function getComEdit ($idCommentaire){
        $content = $this->comment->getComInfo($idCommentaire);
        $vue = new \BlogPSC\Vue ("EditCom");
        $vue->generer(array('contenu' => $content['contenu'], 'auteur' => $content['auteur'], 'id' => $idCommentaire));
    }

    // Edit a comment.
    public function setComEdit ($auteur, $contenu, $idCommentaire){
        $this->comment->updateCom($auteur, $contenu, $idCommentaire);
        $articles = $this->article->getArticles();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('articles' => $articles));

    }

    // Delete a comment.
    public function deleteCom ($idCommentaire){
        $this->comment->deleteComment($idCommentaire);
        $articles = $this->article->getArticles();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('articles' => $articles));
    }

    // Signal a comment.
    public function signalCom($idCommentaire, $idBillet){
        $this->comment->incrementIndex($idCommentaire);
        $article = $this->article->getArticle($idBillet);
        $comments = $this->comment->getComments($idBillet);
        $vue = new \BlogPSC\Vue("Article");
        $vue->generer(array('article' => $article, 'comments' => $comments));
    }


}