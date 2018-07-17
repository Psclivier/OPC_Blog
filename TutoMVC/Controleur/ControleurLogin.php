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

    public function connection()
    {
        $vue = new Vue ("Login");
        $vue->generer([]);
    }

    public function beloged($login, $password){
        $Objlogin = new Login();
        $Objlogin->beloged($login, $password);
        $vue = new Vue ("Login");
        $vue->generer([]);
    }

}






