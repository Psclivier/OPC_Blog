<?php

namespace App\src\DAO;
session_start();
class Login extends DAO
{
    // Vérification des informations rentrées dans les champs.
    public function beloged($login, $password)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            function secureinput($data)
            {
                $data = trim($data); // Supprime les espaces
                $data = stripslashes($data); // Supprime les antislashe
                $data = htmlspecialchars($data); // Bloque les injections de code.
                return $data;
            }
            if (empty($login)){
                throw new Exception("Nom d'utilisateur obligatoire");
            }
            else $loginsecure = secureinput ($login);

            if (empty($password)) {
                throw new Exception("Mot de passe obligatoire.");


            } else {
                $password_hash= sha1($password);
            }
        }

        // Vérification des log avec la bdd.

        $sql = 'SELECT id, login, pssword, rank FROM user WHERE login=? AND pssword=?';
        $confirmation = $this->executerRequete($sql, array($loginsecure, $password_hash));
        $resultat = $confirmation->fetch();


        if ($resultat){

            if(!isset($_SESSION['id']))
            {
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['nom_utilisateur'] = $login;
                $_SESSION['rank'] = $resultat['rank'];
            }

            echo  "Vous êtes connecté" ;


        }else
        {
            echo "Mot de passe ou nom d'utilisateur est éronné ";

        }
    }

    public function registration($login, $password){

        $password_hash = sha1($password);
        $sql = 'INSERT INTO user(login,pssword) VALUES (?,?)';
        $this->executerRequete($sql, array($login, $password_hash));
    }

    public function logOff (){
        session_destroy();
    }
}