<?php session_start();
if ($_SESSION['rank'] == "admin") : ?>
<form method="post" action="index.php?action=setcomedit">
    <input id="auteur" name="auteur" type="text" value=<?= $auteur ?>
           required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4"
              placeholder="Votre commentaire" required><?= $contenu ?></textarea><br />
    <input type="hidden" name="id" value="<?= $id ?>" />
    <input type="submit" class="btn-info" value="Mettre à jour" />
</form>
<?php endif; ?>