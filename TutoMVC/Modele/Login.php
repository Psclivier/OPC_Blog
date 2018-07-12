<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 03/07/2018
 * Time: 10:04
 */



require_once 'Modele/Modele.php';

class Login extends Modele
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

            $sql = 'SELECT id, login, pssword FROM users WHERE login=? AND pssword=?';
            $confirmation = $this->executerRequete($sql, array($loginsecure, $password_hash));
            $resultat = $confirmation->fetch();


        if ($resultat){

            if(!isset($_SESSION['id']))
            {
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['nom_utilisateur'] = $nom_utilisateur;
            }

            echo  "Vous êtes connecté" ;


        }else
        {
            echo "Mot de passe ou nom d'utilisateur est éronné ";

        }
    }
}