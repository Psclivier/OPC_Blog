<?php

// Analyse la requète entrante pour déterminer l'action à entreprendre.

require_once 'ControleurAccueil.php';
require_once 'ControleurBillet.php';
require_once 'ControleurAdmin.php';
require_once 'ControleurLogin.php';
require_once 'Vue/Vue.php';
class Routeur {

    private $ctrlAccueil;
    private $ctrlBillet;

    public function __construct() {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlBillet = new ControleurBillet();
        $this->ctrlLogin = new ControleurLogin();
    }

    // Route une requête entrante : exécute l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'billet') {
                    $idBillet = intval($this->getParametre($_GET, 'id'));
                    if ($idBillet != 0) {
                        $this->ctrlBillet->billet($idBillet);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");
                }

                else if ($_GET['action'] == 'commenter') {
                    $auteur = $this->getParametre($_POST, 'auteur');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->commenter($auteur, $contenu, $idBillet);
                }

                else if ($_GET['action'] == 'poster'){
                    // Poster un Billet.
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $titre = $this->getParametre($_POST, 'titre');
                    $this->ctrlBillet->poster( $contenu, $titre);
                }

                else if ($_GET['action'] == 'supprimer'){
                    // Supprimer commentaire.
                    $idCommentaire = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->supprimer($idCommentaire);
                }

                else if ($_GET['action'] == 'editer'){
                    $titre = $this->getParametre($_POST, 'titre');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->editer($titre, $contenu, $idBillet);
                }

                else if ($_GET['action'] == 'deleteBil'){
                    // Supprimer Billet.
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->supprimerBillet($idBillet);
                }

                else if ($_GET['action'] == 'connection'){
                    $this->ctrlLogin->connection();
                }

                else
                    throw new Exception("Action non valide");
            }

            else {  // aucune action définie : affichage de l'accueil
                $this->ctrlAccueil->accueil();
            }
        }
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }

    // Affiche une erreur
    private function erreur($msgErreur) {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }
        else
            throw new Exception("Paramètre '$nom' absent");
    }

}
