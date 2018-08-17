
<?php session_start();

$this->titre = "Mon Blog - " . $article->getTitle(); ?>

<article id="billet">
    <header>
        <h1 class="titreBillet"><?= $article->getTitle(); ?></h1>
        <time><?= $article->getDate(); ?></time>
    </header>
    <p><?= $article->getContent(); ?></p>


<?php if ($_SESSION['rank'] == "admin") : ?>
    <!--  suppression billet.-->
    <p><a href="<?= "index.php?action=deleteBil&id=" . $article->getId(); ?>" id="delete" class="btn btn-danger">Supprimer</a></p>

    <!-- édition article.  -->
    <p><a href="<?= "index.php?action=getpostedit&id=" . $article->getId();?>"id="edit" class="btn btn-warning">Editer</a></p>
<?php endif; ?>
</article>
<hr />

<header>
    <h1 id="titreReponses">Réponses à <?= $article->getTitle(); ?></h1>
</header>
<?php foreach ($comments as $comment): ?>
<div class="media thumbnail">
    <p><?= $comment->getPseudo(); ?> dit :</p>
    <p><?= $comment->getContent(); ?></p>

<?php if ($_SESSION['rank'] == "admin") : ?>
    <!-- suppression commentaire.   -->
    <p><a href="<?= "index.php?action=supprimer&id=" . $comment->getId(); ?>" id="deletecom" class="button">Supprimer</a></p>

    <!-- édition commentaire.  -->
    <p><a href="<?= "index.php?action=getcomedit&idcom=" . $comment->getId(); ?>"id="editcom" class="button">Editer</a></p>
    <?php endif; ?>

<?php if ($_SESSION['rank'] == "user") : ?>
    <!--  signalement d'un commentaire.  -->
    <p><a href="<?= "index.php?action=signalcom&idcom=" . $comment->getId() . "&id=" . $article->getId(); ?>" id="signal" class="button">Signaler</a></p>
<?php endif; ?>


</div>
<?php endforeach; ?>
<hr />
<?php if (isset($_SESSION['rank'])) : ?>
<form method="post" action="index.php?action=commenter">
    <input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" 
           required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4" 
              placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $article->getId(); ?>" />
    <div class="g-recaptcha" data-sitekey="6LeYuGYUAAAAADoGM4Jc7Xs77ZMc_g3y6_hWicCG"></div>
    <input type="submit" class="button" value="Commenter" />
</form>
<?php endif; ?>
