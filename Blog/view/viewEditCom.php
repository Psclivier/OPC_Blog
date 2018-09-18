<?php 
if (isset($_SESSION['rank']) && ($_SESSION['rank'] == "admin")) : ?>
<form method="post" action="index.php?action=setcomedit">
    <input id="auteur" name="auteur" type="text" value=<?= $comment->getPseudo(); ?>
           required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4"
              placeholder="Votre commentaire" required><?= $comment->getContent(); ?></textarea><br />
    <input type="hidden" name="id" value="<?= $id ?>" />
    <input type="submit" class="btn-info" value="Mettre à jour" />
</form>
<?php endif; ?>