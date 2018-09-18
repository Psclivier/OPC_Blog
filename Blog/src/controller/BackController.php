<?php

namespace App\src\Controller;

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\DAO\Login;
use App\src\Model\View;

class BackController {

    private $article;
    private $comment;
    private $fctrl;

    public function __construct() {
        $this->article = new ArticleDAO();
        $this->comment = new CommentDAO();
        $this->fctrl = new FrontController();
        session_start();
    }
    // Display signalised comments.
    public function moderation(){
        $comments = $this->comment->getAllCom();
        $vue = new View("ComMod");
        $vue->generer(array('comments' => $comments));
    }
    public function connection()
    {
        $vue = new View("Login");
        $vue->generer([]);
    }
    public function beloged($login, $password){
        $Objlogin = new Login();
        $Objlogin->beloged($login, $password);
        $this->fctrl->home();
    }
    public function logOff(){
        $Objlogin = new Login();
        $Objlogin->logOff();
        $this->fctrl->home();
    }
    public function gotoRegistration(){
        $vue = new View("Registration");
        $vue->generer([]);
    }

    public  function registration($login, $password,$confirmpwd){
        $Objlogin = new Login();
        $Objlogin->registration($login, $password,$confirmpwd);
        $this->fctrl->home();
    }


}

