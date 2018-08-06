<?php $this->titre = "Mon Blog - " . $billet['titre']; ?>

<article id="billet">
    <header>
        <h1 class="titreBillet"><?= $billet['titre'] ?></h1>
        <time><?= $billet['date'] ?></time>
    </header>
    <p><?= $billet['contenu'] ?></p>


<?php if ($_SESSION['rank'] == "admin") : ?>
    <!--  suppression billet.-->
    <p><a href="<?= "index.php?action=deleteBil&id=" . $billet['id'] ?>" id="delete" class="btn btn-danger">Supprimer</a></p>

    <!-- édition article.  -->
    <p><a href="<?= "index.php?action=getpostedit&id=" . $billet['id']?>"id="edit" class="btn btn-warning">Editer</a></p>
<?php endif; ?>
</article>
<hr />



<header>
    <h1 id="titreReponses">Réponses à <?= $billet['titre'] ?></h1>
</header>
<?php foreach ($commentaires as $commentaire): ?>
<div class="media thumbnail">
    <p><?= $commentaire['auteur'] ?> dit :</p>
    <p><?= $commentaire['contenu'] ?></p>


<?php if ($_SESSION['rank'] == "admin") : ?>
    <!-- suppression commentaire.   -->
    <p><a href="<?= "index.php?action=supprimer&id=" . $commentaire['id'] ?>" id="deletecom" class="btn btn-danger">Supprimer</a></p>

    <!-- édition commentaire.  -->
    <p><a href="<?= "index.php?action=getcomedit&idcom=" . $commentaire['id'] ?>"id="editcom" class="btn btn-warning">Editer</a></p>
    <?php endif; ?>

<?php if ($_SESSION['rank'] == "user") : ?>
    <!--  signalement d'un commentaire.  -->
    <p><a href="<?= "index.php?action=signalcom&idcom=" . $commentaire['id'] . "&id=" . $billet['id'] ?>" id="signal" class="btn btn-danger">Signaler</a></p>
<?php endif; ?>


</div>
<?php endforeach; ?>
<hr />
<?php if (isset($_SESSION['rank'])) : ?>




<!---->
<?php
//require 'recaptcha.php';
//if (!empty($_POST)){
//    $captcha = new Recaptcha('6LeYuGYUAAAAAMl_WLEuka5-EUp5NbRqM_JwQp5K');
//    if ($captcha->checkCode($_POST['g-recaptcha-response']) === false) {
//        ?>
<!--        <div class="alert alert-danger">-->
<!--            Captcha invalide.-->
<!--        </div>-->
<!--        --><?php
//    } else {
//    }
//    }
//    ?>
<form method="post" action="index.php?action=commenter">
    <input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" 
           required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4" 
              placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
    <div class="g-recaptcha" data-sitekey="6LeYuGYUAAAAADoGM4Jc7Xs77ZMc_g3y6_hWicCG"></div>
    <input type="submit" class="btn-info" value="Commenter" />
</form>




<?php endif; ?>
