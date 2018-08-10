<?php

// Analyse la requète entrante pour déterminer l'action à entreprendre.




require_once 'src/controller/FrontController.php';
require_once 'src/controller/BackController.php';
require_once 'view/Vue.php';
require_once 'recaptcha.php';


class Routeur {


    public function __construct() {
        $this->fcrtl = new \src\controller\FrontController();
        $this->bctrl = new \src\controller\BackController();


    }

    // Route une requête entrante : exécute l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'article') {
                    $idArticle = intval($this->getParametre($_GET, 'id'));
                    if ($idArticle != 0) {
                        $this->fcrtl->article($idArticle);
                    }
                    else
                        throw new Exception("Identifiant de billet non valide");
                }

                // Post a comment.
                else if ($_GET['action'] == 'commenter') {
                    $captcha = new Recaptcha('6LeYuGYUAAAAAMl_WLEuka5-EUp5NbRqM_JwQp5K');
                    if ($captcha->checkCode($_POST['g-recaptcha-response']) === false) {
                        throw new Exception("Captcha non valide");
                    } else {
                        $auteur = $this->getParametre($_POST, 'auteur');
                        $contenu = $this->getParametre($_POST, 'contenu');
                        $idBillet = $this->getParametre($_POST, 'id');
                        $this->fcrtl->comment($auteur, $contenu, $idBillet);
                    }

                }
                // Post an article.
                else if ($_GET['action'] == 'poster'){
                    // Poster un Billet.
                    $contenu = $this->getParametre($_POST, 'editeur');
                    $titre = $this->getParametre($_POST, 'titre');
                    $this->fcrtl->addarticle( $contenu, $titre);
                }
                // Display article edit.
                else if ($_GET['action'] == 'getpostedit'){
                    $idBillet = $this->getParametre($_GET, 'id');
                    $this->fcrtl->getPostEdit($idBillet);
                }
                // Display comment edit.
                else if ($_GET['action'] == 'getcomedit'){
                    $idCommentaire = $this->getParametre($_GET, 'idcom');
                    $this->fcrtl->getComEdit($idCommentaire);
                }
                // Edit article.
                else if ($_GET['action'] == 'setpostedit') {
                    $titre = $this->getParametre($_POST, 'titre');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->fcrtl->setPostEdit($titre, $contenu, $idBillet);
                }
                // Edit comment.
                else if ($_GET['action'] == 'setcomedit') {
                    $auteur = $this->getParametre($_POST, 'auteur');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idCommentaire = $this->getParametre($_POST, 'id');
                    $this->fcrtl->setComEdit($auteur, $contenu, $idCommentaire);
                }
                // Delete an article.
                else if ($_GET['action'] == 'deleteBil'){
                    // Supprimer Billet.
                    $idBillet = $this->getParametre($_GET, 'id');
                    $this->fcrtl->delArticle($idBillet);
                }

                // Delete a comment.
                else if ($_GET['action'] == 'supprimer'){
                    // Supprimer commentaire.
                    $idCommentaire = intval($this->getParametre($_GET, 'id'));
                    $this->fcrtl->deleteCom($idCommentaire);

                }

                // Display login page.
                else if ($_GET['action'] == 'connection'){
                    $this->bctrl->connection();
                }
                // Execute connection.
                else if ($_GET['action'] == 'beloged'){
                    $login = $this->getParametre($_POST, 'login');
                    $password = $this->getParametre($_POST, 'password');
                    $this->bctrl->beloged($login, $password);
                }
                // Execute deconnection.
                else if ($_GET['action'] == 'logoff') {
                    $this->bctrl->logOff();
                }
                // Signal a comment.
                else if ($_GET['action'] == 'signalcom'){
                    $idBillet = $this->getParametre($_GET, 'id');
                    $idCommentaire = $this->getParametre($_GET, 'idcom');
                    $this->fcrtl->signalCom($idCommentaire, $idBillet);
                }
                // Display moderation page.
                else if ($_GET['action'] == 'moderation'){
                    $this->bctrl->moderation();
                }

                // Display text editor page.
                else if ($_GET['action'] == 'gotoEditor') {
                    $this->fcrtl->gotoEditor();
                }

                // Display registration page.
                else if ($_GET['action'] == 'gotoregistration') {
                    $this->ctrlLogin->gotoRegistration();
                }

                // Execute registration.
                else if ($_GET['action'] == 'registration') {
                    $login = $this->getParametre($_POST, 'login');
                    $password = $this->getParametre($_POST, 'password');
                    $this->ctrlLogin->registration($login, $password);
                }

                else
                    throw new Exception("Action non valide");
            }

            else {  // aucune action définie : affichage de l'accueil
                $this->fcrtl->home();
            }
        }
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }

    // Display error message.
    private function erreur($msgErreur) {
        $vue = new \BlogPSC\Vue("Erreur");
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
