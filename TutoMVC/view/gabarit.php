<?php session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width">
<!--        <link rel="stylesheet" href="../public/style.css" />-->
<!--        <link href="../public/bootstrap.css" rel="stylesheet">-->
    <link rel="stylesheet" href="../public/assets/css/main.css"/>
    <noscript>
        <link rel="stylesheet" href="../public/assets/css/noscript.css"/>
    </noscript>
    <title><?= $titre ?></title>

</head>
<body class="is-preload">
<div id="wrapper" class="fade-in">
    <!-- Intro -->
    <div id="intro">
        <h1>BILLET SIMPLE<br />
            POUR L'ALASKA</h1>
        <ul class="actions">
            <li><a href="#header" class="button icon solo fa-arrow-down scrolly">Continue</a></li>
        </ul>
    </div>

    <header>
        <div id="header">
            <h2 id="titreBlog">Le nouveau roman de Jean Forteroche</h2></a>
        </div>

        <nav id="nav">
            <ul class="links">
                <li class="active"><a href="index.php">Accueil</a></li>
                <?php if ($_SESSION['rank'] == "admin") : ?>
                <li><a href="index.php?action=gotoEditor">Ecrire un Article</a></li>
                <li><a href="index.php?action=moderation">Moderation</a></li>
                <?php endif; ?>
                <?php if (!isset($_SESSION['rank'])) : ?>
                <li><a href="index.php?action=connection">Connexion</a></li>
                <li><a href="index.php?action=gotoregistration">Inscription</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['rank'])) : ?>
                <li><a href="index.php?action=logoff">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
            <ul class="icons">
                <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            </ul>
        </nav>
    </header>
    <!-- #contenu -->
    <div id="main">

            <?= $contenu ?>

    </div>


    <!-- Footer -->
    <footer id="footer">
        <section>
            <form method="post" action="#">
                <div class="fields">
                    <div class="field">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" />
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" />
                    </div>
                    <div class="field">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" rows="3"></textarea>
                    </div>
                </div>
                <ul class="actions">
                    <li><input type="submit" value="Send Message" /></li>
                </ul>
            </form>
        </section>
        <section class="split contact">
            <section class="alt">
                <h3>Address</h3>
                <p>1234 Somewhere Road #87257<br />
                    Nashville, TN 00000-0000</p>
            </section>
            <section>
                <h3>Phone</h3>
                <p><a href="#">(000) 000-0000</a></p>
            </section>
            <section>
                <h3>Email</h3>
                <p><a href="#">info@untitled.tld</a></p>
            </section>
        </section>
    </footer>

    <!-- Copyright -->
    <div id="copyright">
        <ul><li>&copy; Untitled</li><li>Design: <a href="https://html5up.net">HTML5 UP</a></li></ul>
    </div>

            </p>
        </div>
    </footer>
</div>
<script type="text/javascript" src="../public/jquery.min.js"></script>
<script type="text/javascript" src="../public/plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../public/plugin/tinymce/initmce.js"></script>
<script src='../public/https://www.google.com/recaptcha/api.js'></script>
<script src="../public/assets/js/jquery.min.js"></script>
<script src="../public/assets/js/jquery.scrollex.min.js"></script>
<script src="../public/assets/js/jquery.scrolly.min.js"></script>
<script src="../public/assets/js/browser.min.js"></script>
<script src="../public/assets/js/breakpoints.min.js"></script>
<script src="../public/assets/js/util.js"></script>
<script src="../public/assets/js/main.js"></script>

</body>
</html>