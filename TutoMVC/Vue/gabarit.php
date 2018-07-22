<?php session_start();
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="Contenu/style.css" />
        <link href="Contenu/bootstrap.css" rel="stylesheet">
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script src="Contenu/TinyMce.js"></script>
        <script>tinymce.init({ });</script>
        <title><?= $titre ?></title>

    </head>
    <body>
        <div id="global">
            <header>
                <h1 id="titreBlog">Mon Blog</h1></a>
                <p>Je vous souhaite la bienvenue sur ce modeste blog.</p>
                <?php if (isset($_SESSION['rank'])) {
                    echo "Bonjour" . $_SESSION['nom_utilisateur'];

                }?>
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