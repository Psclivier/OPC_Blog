<?php $this->titre = "Mon Blog - " . $billet['titre']; ?>

<article>
    <header>
        <h1 class="titreBillet"><?= $billet['titre'] ?></h1>
        <time><?= $billet['date'] ?></time>
    </header>
    <p><?= $billet['contenu'] ?></p>


<?php if ($_SESSION['rank'] == "admin") : ?>
    <!--  suppression billet.-->
    <p><a href="<?= "index.php?action=deleteBil&id=" . $billet['id'] ?>"class="btn btn-danger">Supprimer</a></p>

    <!-- Formulaire edition billet.-->
    <form method="post" id="editer" action="index.php?action=getpostedit">
        <input type="hidden" name="contenu" value="<?= $billet['contenu'] ?>" />
        <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
        <input type="hidden" name="titre" value="<?= $billet['titre'] ?>" />
        <input type="hidden" name="date" value="<?= $billet['date'] ?>" />
        <input type="submit" class="btn-warning" name="edit_submit" value="Editer" />
    </form>
    <!-- édition commentaire.  -->
    <p><a href="<?= "index.php?action=getpostedit&id=" . $billet['id'] . "&titre=" . $billet['titre'] . "&contenu=" . $billet['contenu'] . "&date=" . $billet['date'] ?>"class="btn btn-warning">Editer</a></p>
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
    <p><a href="<?= "index.php?action=supprimer&id=" . $commentaire['id'] ?>" class="btn btn-danger">Supprimer</a></p>


    <!-- édition commentaire.  -->
    <p><a href="<?= "index.php?action=getcomedit&id=" . $commentaire['id'] . "&auteur=" . $commentaire['auteur'] . "&contenu=" . $commentaire['contenu'] ?>"class="btn btn-warning">Editer</a></p>
    <?php endif; ?>

    <!--  signalement d'un commentaire.  -->
    <p><a href="<?= "index.php?action=signalcom&id=" . $commentaire['id'] ?>"class="btn btn-danger">Signaler</a></p>



</div>
<?php endforeach; ?>
<hr />
<?php if (isset($_SESSION['rank'])) : ?>
<form method="post" action="index.php?action=commenter">
    <input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" 
           required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4" 
              placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
    <input type="submit" class="btn-info" value="Commenter" />
</form>
<?php endif; ?>
