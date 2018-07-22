<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 03/07/2018
 * Time: 10:04
 */


require_once 'Modele/Login.php';

Class ControleurLogin
{
    private $billet;

    public function __construct() {
        $this->billet = new Billet();
    }

    public function connection()
    {
        $vue = new Vue ("Login");
        $vue->generer([]);
    }

    public function beloged($login, $password){
        $Objlogin = new Login();
        $Objlogin->beloged($login, $password);
        $billets = $this->billet->getBillets();
        $vue = new Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }
    public function logOff(){
        $Objlogin = new Login();
        $Objlogin->logOff();
        $billets = $this->billet->getBillets();
        $vue = new Vue("Accueil");
        $vue->generer(array('billets' => $billets));
    }
    public function gotoRegistration(){
        $vue = new Vue ("Registration");
        $vue->generer([]);
    }

    public  function registration($login, $password){
        $Objlogin = new Login();
        $Objlogin->registration($login, $password);
    }

}






