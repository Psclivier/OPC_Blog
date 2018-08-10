<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 06/08/2018
 * Time: 16:33
 */

namespace src\controller;

use src\DAO\Login;

require_once 'view/Vue.php';
require_once 'src/DAO/ArticleDAO.php';
require_once 'src/DAO/CommentDAO.php';
require_once 'src/DAO/Login.php';

class BackController {

    private $article;
    private $comment;

    public function __construct() {
        $this->article = new \src\DAO\ArticleDAO();
        $this->comment = new \src\DAO\CommentDAO();
    }

    // Display signalised comments.
    public function moderation(){
        $comments = $this->comment->getAllCom();
        $vue = new \BlogPSC\Vue ("ComMod");
        $vue->generer(array('comments' => $comments));
    }


    public function connection()
    {
        $vue = new \BlogPSC\Vue ("Login");
        $vue->generer([]);
    }

    public function beloged($login, $password){
        $Objlogin = new Login();
        $Objlogin->beloged($login, $password);
        $articles = $this->article->getArticles();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('articles' => $articles));
    }
    public function logOff(){
        $Objlogin = new Login();
        $Objlogin->logOff();
        $articles = $this->article->getArticles();
        $vue = new \BlogPSC\Vue("Accueil");
        $vue->generer(array('articles' => $articles));
    }
    public function gotoRegistration(){
        $vue = new \BlogPSC\Vue ("Registration");
        $vue->generer([]);
    }

    public  function registration($login, $password){
        $Objlogin = new Login();
        $Objlogin->registration($login, $password);
    }


}

