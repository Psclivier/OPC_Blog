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
        $this->ctrlAdmin = new ControleurAdmin();
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
                // Poster un commentaire.
                else if ($_GET['action'] == 'commenter') {
                    $auteur = $this->getParametre($_POST, 'auteur');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->commenter($auteur, $contenu, $idBillet);
                }
                // Poster un article.
                else if ($_GET['action'] == 'poster'){
                    // Poster un Billet.
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $titre = $this->getParametre($_POST, 'titre');
                    $this->ctrlBillet->poster( $contenu, $titre);
                }
                // Afficher l'édition d'un article
                else if ($_GET['action'] == 'getpostedit'){
                    $titre = $this->getParametre($_POST, 'titre');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idBillet = $this->getParametre($_POST, 'id');
                    $date = $this->getParametre($_POST, 'date');
                    $this->ctrlBillet->getPostEdit($titre, $contenu, $idBillet, $date);
                }
                // Afficher l'édition d'un commentaire.
                else if ($_GET['action'] == 'getcomedit'){
                    $idBillet = $this->getParametre($_POST, 'id');
                    $auteur = $this->getParametre($_POST, 'auteur');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idCommentaire = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->getComEdit($auteur, $contenu, $idCommentaire, $idBillet);
                }
                // Effectuer l'édition d'un article.
                else if ($_GET['action'] == 'setpostedit') {
                    $titre = $this->getParametre($_POST, 'titre');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->setPostEdit($titre, $contenu, $idBillet);
                }
                // Effectuer l'édition d'un commentaire.
                else if ($_GET['action'] == 'setcomedit') {
                    $auteur = $this->getParametre($_POST, 'auteur');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idCommentaire = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->setComEdit($auteur, $contenu, $idCommentaire);
                }
                // Supprimer un article
                else if ($_GET['action'] == 'deleteBil'){
                    // Supprimer Billet.
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->supprimerBillet($idBillet);
                }
                // Supprimer commentaire.
                else if ($_GET['action'] == 'supprimer'){
                    // Supprimer commentaire.
                    $idCommentaire = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->supprimer($idCommentaire);
                }
                // Afficher la page de login.
                else if ($_GET['action'] == 'connection'){
                    $this->ctrlLogin->connection();
                }
                // Effectuer la connection admin.
                else if ($_GET['action'] == 'beloged'){
                    $login = $this->getParametre($_POST, 'login');
                    $password = $this->getParametre($_POST, 'password');
                    $this->ctrlLogin->beloged($login, $password);
                }
                else if ($_GET['action'] == 'signalcom'){
                    $idCommentaire = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->signalCom($idCommentaire);
                }
                // Afficher page modération.
                else if ($_GET['action'] == 'moderation'){
                    $this->ctrlAdmin->moderation();
                }
                // Afficher page d'écriture d'article.
                else if ($_GET['action'] == 'gotoEditor') {
                    $this->ctrlBillet->gotoEditor();
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
