<?php $this->titre = "Mon Blog - " . $billet['titre']; ?>

<article>
    <header>
        <h1 class="titreBillet"><?= $billet['titre'] ?></h1>
        <time><?= $billet['date'] ?></time>
    </header>
    <p><?= $billet['contenu'] ?></p>




    <!--  Formulaire suppression billet.-->
    <form method="post" id="supprimer"  action="index.php?action=deleteBil">
        <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
        <input type="submit" class="btn-danger" value="Supprimer" />
    </form>
    <!-- Formulaire edition billet.-->
    <form method="post" id="editer" action="index.php?action=getpostedit">
        <input type="hidden" name="contenu" value="<?= $billet['contenu'] ?>" />
        <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
        <input type="hidden" name="titre" value="<?= $billet['titre'] ?>" />
        <input type="hidden" name="date" value="<?= $billet['date'] ?>" />
        <input type="submit" class="btn-warning" name="edit_submit" value="Editer" />
    </form>
</article>
<hr />



<header>
    <h1 id="titreReponses">Réponses à <?= $billet['titre'] ?></h1>
</header>
<?php foreach ($commentaires as $commentaire): ?>
    <p><?= $commentaire['auteur'] ?> dit :</p>
    <p><?= $commentaire['contenu'] ?></p>



    <!-- Formulaire suppression commentaire.   -->
    <form method="post" id="supprimer" action="index.php?action=supprimer">
        <input type="hidden" name="id" value="<?= $commentaire['id'] ?>" />
        <input type="submit" class="btn-danger" value="Supprimer" />
    </form>


    <!--  Formulaire édition commentaire.  -->
    <form method="post" id="editer" action="index.php?action=getcomedit">
        <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
        <input type="hidden" name="id" value="<?= $commentaire['id'] ?>" />
        <input type="hidden" name="contenu" value="<?= $commentaire['contenu'] ?>" />
        <input type="hidden" name="auteur" value="<?= $commentaire['auteur'] ?>" />
        <input type="submit" class="btn-warning" value="Editer" />
    </form>

    <!--  Formulaire signalement d'un commentaire.  -->
    <form method="post" action="index.php?action=signalcom">
        <input type="hidden" name="id" value="<?= $commentaire['id'] ?>" />
        <input type="submit" class="btn-danger" value="Signaler" />
    </form>

<?php endforeach; ?>
<hr />
<form method="post" action="index.php?action=commenter">
    <input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" 
           required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4" 
              placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $billet['id'] ?>" />
    <input type="submit" class="btn-group-lg" value="Commenter" />
</form>

