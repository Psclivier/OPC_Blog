<?php

// Analyse la requète entrante pour déterminer l'action à entreprendre.

require_once 'src/Controleur/ControleurAccueil.php';
require_once 'src/Controleur/ControleurBillet.php';
require_once 'src/Controleur/ControleurAdmin.php';
require_once 'src/Controleur/ControleurLogin.php';
require_once 'Vue/Vue.php';
require_once 'recaptcha.php';


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
                    $captcha = new Recaptcha('6LeYuGYUAAAAAMl_WLEuka5-EUp5NbRqM_JwQp5K');
                    if ($captcha->checkCode($_POST['g-recaptcha-response']) === false) {
                        throw new Exception("Captcha non valide");
                    } else {
                        $auteur = $this->getParametre($_POST, 'auteur');
                        $contenu = $this->getParametre($_POST, 'contenu');
                        $idBillet = $this->getParametre($_POST, 'id');
                        $this->ctrlBillet->commenter($auteur, $contenu, $idBillet);
                    }

                }
                // Poster un article.
                else if ($_GET['action'] == 'poster'){
                    // Poster un Billet.
                    $contenu = $this->getParametre($_POST, 'editeur');
                    $titre = $this->getParametre($_POST, 'titre');
                    $this->ctrlBillet->poster( $contenu, $titre);
                }
                // Afficher l'édition d'un article
                else if ($_GET['action'] == 'getpostedit'){
                    $idBillet = $this->getParametre($_GET, 'id');
                    $this->ctrlBillet->getPostEdit($idBillet);
                }
                // Afficher l'édition d'un commentaire.
                else if ($_GET['action'] == 'getcomedit'){
                    $idCommentaire = $this->getParametre($_GET, 'idcom');
                    $this->ctrlBillet->getComEdit($idCommentaire);
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
                    $idBillet = $this->getParametre($_GET, 'id');
                    $this->ctrlBillet->supprimerBillet($idBillet);
                }

                // Supprimer commentaire.
                else if ($_GET['action'] == 'supprimer'){
                    // Supprimer commentaire.
                    $idCommentaire = intval($this->getParametre($_GET, 'id'));
                    $this->ctrlBillet->supprimer($idCommentaire);

                }

                // Afficher la page de login.
                else if ($_GET['action'] == 'connection'){
                    $this->ctrlLogin->connection();
                }
                // Effectuer la connection .
                else if ($_GET['action'] == 'beloged'){
                    $login = $this->getParametre($_POST, 'login');
                    $password = $this->getParametre($_POST, 'password');
                    $this->ctrlLogin->beloged($login, $password);
                }
                // Deconnexion
                else if ($_GET['action'] == 'logoff') {
                    $this->ctrlLogin->logOff();
                }
                // Signaler un commentaire.
                else if ($_GET['action'] == 'signalcom'){
                    $idCommentaire = $this->getParametre($_GET, 'id');
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

                // Afficher page d'inscription.
                else if ($_GET['action'] == 'gotoregistration') {
                    $this->ctrlLogin->gotoRegistration();
                }

                // Valider l'inscription.
                else if ($_GET['action'] == 'registration') {
                    $login = $this->getParametre($_POST, 'login');
                    $password = $this->getParametre($_POST, 'password');
                    $this->ctrlLogin->registration($login, $password);
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
