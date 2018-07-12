<?php
/**
 * Created by PhpStorm.
 * User: Paulin
 * Date: 11/07/2018
 * Time: 10:16
 */
?>

<?php $this->titre = "Mon Blog - "; ?>

<?php
var_dump($idBillet);
?>

<form method="post" action="index.php?action=setcomedit">
    <input id="auteur" name="auteur" type="text" placeholder=<?= $auteur ?>
           required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4"
              placeholder="Votre commentaire" required><?= $contenu ?></textarea><br />
    <input type="hidden" name="id" value="<?= $_POST["id"] ?>" />
    <input type="submit" value="Commenter" />
</form>
