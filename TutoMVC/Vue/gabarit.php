<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="Contenu/style.css" />
        <link href="Contenu/bootstrap.css" rel="stylesheet">
        <title><?= $titre ?></title>

    </head>
    <body>
        <div id="global">
            <header>
                <a href="index.php"><h1 id="titreBlog">Mon Blog</h1></a>
                <p>Je vous souhaite la bienvenue sur ce modeste blog.</p>
                <a href="index.php?action=gotoEditor"> Ecrire un article </a>
                <a href="index.php?action=moderation"> moderation </a>
            </header>
            <div id="contenu">
                <?= $contenu ?>
            </div> <!-- #contenu -->
            <footer id="piedBlog">
                Blog réalisé avec PHP, HTML5 et CSS. <a href="index.php?action=connection"> se connecter </a>
            </footer>
        </div> <!-- #global -->
    </body>
</html>