<?php session_start();
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="public/style.css" />
        <link href="public/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="public/jquery.min.js"></script>
        <script type="text/javascript" src="public/plugin/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="public/plugin/tinymce/initmce.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <title><?= $titre ?></title>

    </head>
    <body>
        <div id="global">
            <header>
                <h1 id="titreBlog">Mon Blog</h1></a>
                <p>
                <?php if (isset($_SESSION['rank'])) {
                    echo "Bonjour " . $_SESSION['nom_utilisateur'];

                }?></p>
                <nav class="navbar navbar-default">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"> Accueil </a>
                        </li>
                        <?php if ($_SESSION['rank'] == "admin") : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=gotoEditor"> Ecrire un article </a>
                        </li>
                        <li>
                            <a class="nav-link" href="index.php?action=moderation"> Moderation </a>
                        </li>
                        <?php endif; ?>
                        <?php if (!isset($_SESSION['rank'])) : ?>
                        <li>
                            <a class="nav-link" href="index.php?action=connection"> Connexion </a>
                        </li>
                        <li>
                            <a class="nav-link" href="index.php?action=gotoregistration"> Inscription </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a class="nav-link" href="index.php?action=logoff"> Déconnexion </a>
                        </li>
                    </ul>
                </nav>
            </header>
            <div id="contenu">
                <?= $contenu ?>
            </div> <!-- #contenu -->
            <footer id="piedBlog">
                Blog réalisé avec PHP, HTML5 et CSS.
            </footer>
        </div>
    </body>
</html>